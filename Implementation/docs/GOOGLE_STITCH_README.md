# Google Stitch Integration Guide - Kif-Kif Platform

## Overview
This document provides instructions for integrating the Kif-Kif platform with Google Stitch for database synchronization and real-time data management.

## Prerequisites
- Google Stitch account
- Google Cloud project with Stitch enabled
- Firebase project (for authentication integration)
- MongoDB Atlas (if using MongoDB as Stitch backend)

## Setup Instructions

### 1. Create Google Stitch Project
1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project or select existing one
3. Enable Google Stitch API
4. Create a new Stitch application

### 2. Configure Database Connection
1. In Stitch console, go to "Linked Data Sources"
2. Add your MySQL database connection:
   - Connection Name: kifkif-mysql
   - Host: your-mysql-host
   - Port: 3306
   - Database: kifkif
   - Username: your-username
   - Password: your-password

### 3. Create Stitch Functions

### Function: getUserDashboard
```javascript
exports = function(userId, role) {
  const users = context.services.get("kifkif-mysql").db("kifkif").collection("users");
  const user = users.findOne({ _id: userId });
  
  if (role === 'admin') {
    return {
      redirect: '/admin/dashboard',
      stats: {
        entreprises_total: context.services.get("kifkif-mysql").db("kifkif").collection("entreprises").count(),
        entreprises_en_attente: context.services.get("kifkif-mysql").db("kifkif").collection("entreprises").count({ statut_validation: 'en_attente' }),
        utilisateurs_total: context.services.get("kifkif-mysql").db("kifkif").collection("users").count()
      }
    };
  } else if (role === 'entreprise') {
    return {
      redirect: '/entreprise/dashboard',
      stats: {
        annonces_actives: context.services.get("kifkif-mysql").db("kifkif").collection("ressources").count({ entreprise_id: userId, statut: 'active' }),
        annonces_total: context.services.get("kifkif-mysql").db("kifkif").collection("ressources").count({ entreprise_id: userId })
      }
    };
  } else if (role === 'particulier') {
    return {
      redirect: '/particulier/dashboard'
    };
  }
};
```

### Function: validateEntreprise
```javascript
exports = function(entrepriseId) {
  const entreprises = context.services.get("kifkif-mysql").db("kifkif").collection("entreprises");
  const result = entreprises.updateOne(
    { _id: entrepriseId },
    { $set: { statut_validation: 'validee' } }
  );
  return { success: result.modifiedCount > 0 };
};
```

### Function: rejectEntreprise
```javascript
exports = function(entrepriseId) {
  const entreprises = context.services.get("kifkif-mysql").db("kifkif").collection("entreprises");
  const result = entreprises.updateOne(
    { _id: entrepriseId },
    { $set: { statut_validation: 'rejetee' } }
  );
  return { success: result.modifiedCount > 0 };
};
```

### Function: searchRessources
```javascript
exports = function(query, categorie, ville) {
  const ressources = context.services.get("kifkif-mysql").db("kifkif").collection("ressources");
  
  let filter = { statut: 'active' };
  
  if (query) {
    filter.$or = [
      { titre: { $regex: query, $options: 'i' } },
      { description: { $regex: query, $options: 'i' } }
    ];
  }
  
  if (categorie) {
    filter.categorie_id = categorie;
  }
  
  if (ville) {
    filter.localisation = { $regex: ville, $options: 'i' };
  }
  
  return ressources.find(filter).toArray();
};
```

### 4. Configure Stitch Rules

### Rule: users collection
```json
{
  "roles": [
    {
      "name": "admin",
      "apply_when": { "role": "admin" },
      "read": true,
      "write": true
    },
    {
      "name": "owner",
      "apply_when": { "_id": "%%user.id" },
      "read": true,
      "write": true
    }
  ]
}
```

### Rule: entreprises collection
```json
{
  "roles": [
    {
      "name": "admin",
      "apply_when": { "role": "admin" },
      "read": true,
      "write": true
    },
    {
      "name": "entreprise_owner",
      "apply_when": { "entreprise_id": "%%user.id" },
      "read": true,
      "write": true
    }
  ]
}
```

### Rule: ressources collection
```json
{
  "roles": [
    {
      "name": "public_read",
      "apply_when": {},
      "read": true,
      "write": false
    },
    {
      "name": "entreprise_write",
      "apply_when": { "entreprise_id": "%%user.id" },
      "read": true,
      "write": true
    }
  ]
}
```

### 5. Enable Real-time Sync

### Sync Configuration for ressources
```javascript
{
  "name": "ressources_sync",
  "database": "kifkif",
  "collection": "ressources",
  "query": { "statut": "active" },
  "fields": {
    "titre": 1,
    "description": 1,
    "prix_unitaire": 1,
    "localisation": 1,
    "entreprise_id": 1,
    "categorie_id": 1
  }
}
```

### 6. Laravel Integration

### Install Stitch SDK
```bash
composer require mongodb/stitch-php-sdk
```

### Create Stitch Service
```php
<?php

namespace App\Services;

use MongoDB\Client;
use MongoDB\Stitch\StitchClient;

class StitchService
{
    private $client;
    
    public function __construct()
    {
        $this->client = new StitchClient(
            config('stitch.app_id'),
            config('stitch.server_url')
        );
    }
    
    public function callFunction($functionName, $args = [])
    {
        return $this->client->callFunction($functionName, $args);
    }
    
    public function syncCollection($collectionName, $query = [])
    {
        return $this->client->sync($collectionName, $query);
    }
}
```

### Add to config/services.php
```php
'stitch' => [
    'app_id' => env('STITCH_APP_ID'),
    'server_url' => env('STITCH_SERVER_URL', 'https://stitch.mongodb.com'),
    'api_key' => env('STITCH_API_KEY'),
],
```

### Add to .env
```env
STITCH_APP_ID=your-app-id
STITCH_SERVER_URL=https://stitch.mongodb.com
STITCH_API_KEY=your-api-key
```

### 7. Real-time Updates in Controllers

### Example: MarketplaceController with Stitch
```php
<?php

namespace App\Http\Controllers;

use App\Services\StitchService;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    private $stitch;
    
    public function __construct(StitchService $stitch)
    {
        $this->stitch = $stitch;
    }
    
    public function index(Request $request)
    {
        // Use Stitch for real-time data
        $ressources = $this->stitch->callFunction('searchRessources', [
            'query' => $request->input('q'),
            'categorie' => $request->input('categorie'),
            'ville' => $request->input('ville')
        ]);
        
        $categories = Categorie::whereNull('parent_id')->get();
        $villes = Ressource::distinct('localisation')->pluck('localisation')->filter();
        
        return view('marketplace.index', compact('ressources', 'categories', 'villes'));
    }
}
```

### 8. Authentication Integration

### Firebase Authentication with Stitch
```javascript
// In Stitch Functions
exports = function(email, password) {
  const auth = context.services.get("firebase-auth");
  const user = auth.signInWithEmailAndPassword(email, password);
  
  // Get user role from database
  const users = context.services.get("kifkif-mysql").db("kifkif").collection("users");
  const userData = users.findOne({ email: email });
  
  return {
    user: user,
    role: userData.role,
    redirect: getRedirectUrl(userData.role)
  };
};
```

### 9. Webhooks Configuration

### Webhook: entreprise_validated
```javascript
exports = function(payload) {
  const entreprises = context.services.get("kifkif-mysql").db("kifkif").collection("entreprises");
  const entreprise = entreprises.findOne({ _id: payload.entrepriseId });
  
  // Send notification to entreprise
  const notifications = context.services.get("kifkif-mysql").db("kifkif").collection("notifications");
  notifications.insertOne({
    user_id: payload.userId,
    type: 'validation',
    contenu: 'Votre entreprise a été validée',
    date_creation: new Date(),
    statut_lecture: false
  });
  
  return { success: true };
};
```

### 10. Monitoring and Logging

### Enable Stitch Logs
```javascript
exports = function() {
  const logs = context.services.get("kifkif-mysql").db("kifkif").collection("stitch_logs");
  logs.insertOne({
    timestamp: new Date(),
    function_name: "getUserDashboard",
    user_id: context.user.id,
    success: true
  });
};
```

## Testing

### Test Stitch Connection
```bash
php artisan stitch:test
```

### Test Functions
```php
php artisan stitch:call getUserDashboard --args='{"userId": "123", "role": "admin"}'
```

## Troubleshooting

### Common Issues
1. **Connection Timeout**: Check firewall settings and allowlist Stitch IP addresses
2. **Authentication Errors**: Verify API keys and permissions
3. **Sync Delays**: Check query complexity and add appropriate indexes

### Debug Mode
Enable debug mode in `.env`:
```env
STITCH_DEBUG=true
```

## Security Best Practices
1. Use environment variables for sensitive data
2. Implement proper role-based access control
3. Enable encryption for data in transit
4. Regularly rotate API keys
5. Monitor Stitch logs for suspicious activity

## Performance Optimization
1. Use Stitch sync for frequently accessed data
2. Implement caching for expensive queries
3. Optimize database indexes
4. Use Stitch functions for complex operations
5. Monitor function execution time

## Resources
- [Google Stitch Documentation](https://cloud.google.com/stitch)
- [MongoDB Stitch SDK](https://www.mongodb.com/docs/stitch/)
- [Laravel Integration Guide](https://laravel.com/docs)
