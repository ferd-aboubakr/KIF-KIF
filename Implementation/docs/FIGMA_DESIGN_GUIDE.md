# Figma Design Guide - Kif-Kif Platform

## Overview
This guide provides detailed specifications for creating Figma mockups for the Kif-Kif B2B resource management platform. All designs should follow modern UI/UX principles with consistency across all screens.

## Design System

### Color Palette
```css
/* Primary Colors */
--emerald-50: #ecfdf5
--emerald-500: #10b981
--emerald-600: #059669
--emerald-700: #047857

/* Secondary Colors */
--blue-500: #3b82f6
--blue-600: #2563eb
--blue-700: #1d4ed8

/* Neutral Colors */
--gray-50: #f9fafb
--gray-100: #f3f4f6
--gray-200: #e5e7eb
--gray-300: #d1d5db
--gray-400: #9ca3af
--gray-500: #6b7280
--gray-600: #4b5563
--gray-700: #374151
--gray-800: #1f2937
--gray-900: #111827

/* Status Colors */
--green-100: #d1fae5
--green-700: #15803d
--amber-100: #fef3c7
--amber-700: #a16207
--red-50: #fef2f2
--red-600: #dc2626
```

### Typography
- **Font Family**: Inter (Google Fonts)
- **Font Weights**: 300, 400, 500, 600, 700
- **Headings**: 600-700 weight
- **Body Text**: 400 weight
- **Small Text**: 300-400 weight

### Spacing
- **Base Unit**: 4px (0.25rem)
- **Scale**: 4, 8, 12, 16, 20, 24, 32, 48, 64px
- **Container Padding**: 16px (mobile), 32px (desktop)

### Border Radius
- **Small**: 6px (buttons, inputs)
- **Medium**: 8px (cards)
- **Large**: 12px (modals)
- **Extra Large**: 16px (hero sections)

### Shadows
- **Small**: 0 1px 3px rgba(0, 0, 0, 0.1)
- **Medium**: 0 4px 6px rgba(0, 0, 0, 0.1)
- **Large**: 0 10px 15px rgba(0, 0, 0, 0.1)

## Screen Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px - 1023px
- **Desktop**: ≥ 1024px

## Component Library

### Buttons
```
Primary Button (Emerald):
- Background: emerald-500 → emerald-600 (hover)
- Text: white
- Padding: 12px 24px
- Border Radius: 6px
- Font Weight: 500

Secondary Button (Gray):
- Background: white
- Border: gray-200
- Text: gray-700
- Padding: 12px 24px
- Border Radius: 6px

Danger Button (Red):
- Background: red-50
- Border: red-200
- Text: red-600
- Padding: 12px 24px
- Border Radius: 6px
```

### Form Inputs
```
Text Input:
- Background: white
- Border: gray-200 → gray-400 (focus)
- Padding: 12px 16px
- Border Radius: 6px
- Font Size: 14px
- Placeholder: gray-400

Select Dropdown:
- Same as text input with dropdown arrow
- Options: white background, gray-700 text

Checkbox:
- Border: gray-300
- Check: emerald-500
- Size: 16px
```

### Cards
```
Standard Card:
- Background: white
- Border: none
- Shadow: small
- Border Radius: 8px
- Padding: 24px

Stat Card:
- Background: white
- Icon: emerald-100 background, emerald-600 color
- Title: gray-600, small text
- Value: gray-800, large text
- Shadow: small → medium (hover)
```

## Page Layouts

### Desktop Layout
```
Header (64px height):
- Logo + Navigation
- User menu (notifications, profile)

Sidebar (256px width):
- Fixed position
- Logo at top
- Navigation items
- Logout button at bottom

Main Content:
- Margin-left: 256px
- Padding: 32px
- Full width content
```

### Mobile Layout
```
Header (56px height):
- Logo
- Hamburger menu
- Sticky position

Mobile Sidebar:
- Overlay background
- Slide-in from left
- 256px width
- Full height

Main Content:
- Full width
- Padding: 16px
- No margin for sidebar
```

## Page Specifications

### 1. Login Page
**Desktop (1024px+):**
- Centered form container (400px width)
- Logo at top (48px height)
- Email and password fields
- Remember checkbox
- Login button (full width)
- Register link at bottom

**Mobile (<768px):**
- Full width form with 16px padding
- Same elements as desktop
- Touch-friendly button heights (48px minimum)

### 2. Admin Dashboard
**Desktop:**
- Sidebar with navigation
- Main content area with:
  - Stats grid (4 columns)
  - Recent enterprises table
  - Charts section

**Mobile:**
- Collapsible sidebar
- Stats grid (2 columns)
- Stacked table view
- Horizontal scroll for charts

### 3. Enterprise Dashboard
**Desktop:**
- Blue theme (vs emerald for admin)
- Stats cards: active annonces, total annonces, transactions
- Recent annonces table
- Quick actions section

**Mobile:**
- Blue header
- Single column stats
- Compact table view

### 4. Particulier Dashboard
**Desktop:**
- Emerald theme
- Welcome banner (gradient)
- Quick action cards
- Profile information section

**Mobile:**
- Emerald header
- Stacked cards
- Simplified profile view

### 5. Marketplace
**Desktop:**
- Hero section with search
- Filter sidebar (256px)
- Resource grid (3 columns)
- Pagination

**Mobile:**
- Compact hero
- Filter dropdowns
- Resource grid (1 column)
- Load more button

## Icons and Assets

### Icon Library
- **Material Symbols Outlined** (Google Fonts)
- Size: 24px (standard), 20px (small), 32px (large)
- Color: gray-600 (default), emerald-500 (active)

### Logo Specifications
- **Primary Logo**: "Kif-Kif" text
- **Font**: Inter, 700 weight
- **Color**: emerald-600
- **Size**: 32px (desktop), 24px (mobile)

### Avatar Placeholders
- **Size**: 40px (small), 48px (medium), 64px (large)
- **Background**: gray-100
- **Icon**: person icon in gray-400

## Responsive Behavior

### Navigation
- **Desktop**: Horizontal menu in header + sidebar
- **Mobile**: Hamburger menu → slide-out sidebar
- **Tablet**: Either desktop or mobile based on content

### Tables
- **Desktop**: Full table with all columns
- **Mobile**: Card-based layout or horizontal scroll
- **Sort/Filter**: Dropdowns on mobile

### Forms
- **Desktop**: Side-by-side layout
- **Mobile**: Stacked single column
- **Buttons**: Full width on mobile

## Animation Guidelines

### Micro-interactions
- **Button hover**: 0.2s ease-in-out
- **Card hover**: Shadow change, 0.2s
- **Sidebar slide**: 0.3s ease-in-out
- **Form focus**: Border color change, 0.1s

### Loading States
- **Buttons**: Spinner with reduced opacity
- **Cards**: Skeleton placeholders
- **Tables**: Loading overlay

## Figma Setup Instructions

### 1. Create Design System File
1. New file → Design System
2. Create color styles
3. Create text styles
4. Create component variants

### 2. Create Page Templates
1. Desktop frame (1440px width)
2. Mobile frame (375px width)
3. Tablet frame (768px width)

### 3. Component Organization
```
📁 Components/
  📁 Buttons/
    🎨 Primary Button
    🎨 Secondary Button
    🎨 Danger Button
  📁 Forms/
    🎨 Text Input
    🎨 Select
    🎨 Checkbox
  📁 Cards/
    🎨 Standard Card
    🎨 Stat Card
  📁 Navigation/
    🎨 Sidebar
    🎨 Header
```

### 4. Auto Layout
- Use Auto Layout for responsive components
- Set constraints for resizing
- Create variants for different states

### 5. Prototyping
- Link pages together
- Add hover states
- Create mobile transitions
- Test user flows

## Export Guidelines

### Assets Export
- **PNG**: 2x resolution for retina displays
- **SVG**: For icons and logos
- **JSON**: For design tokens

### Developer Handoff
- Use Figma's Inspect panel
- Export CSS variables
- Provide component specifications
- Include responsive breakpoints

## Testing Checklist

### Design Review
- [ ] All screens designed for mobile, tablet, desktop
- [ ] Consistent spacing and typography
- [ ] All interactive states defined
- [ ] Accessibility considered (contrast, focus states)
- [ ] Loading and error states included

### Component Library
- [ ] All reusable components created
- [ ] Variants documented
- [ ] Auto Layout applied
- [ ] Naming convention consistent

### Responsive Testing
- [ ] Mobile layout tested (375px)
- [ ] Tablet layout tested (768px)
- [ ] Desktop layout tested (1440px)
- [ ] Breakpoints working correctly

## Resources
- **Figma Community**: Search for "Laravel Dashboard" templates
- **Google Fonts**: Inter font family
- **Material Symbols**: Icon library
- **Tailwind CSS**: Color and spacing reference
