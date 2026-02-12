# Menu Pricing Policy

## Overview
The web application menu does NOT display prices to maintain an elegant, upscale presentation. Prices remain fully functional in the Restaurant POS application for staff billing purposes.

## Implementation

### Web Application (Public-Facing)
**Location:** `resources/views/menu/index.blade.php`

**What's Hidden:**
- ✅ Price display removed from menu cards
- ✅ LKR pricing information not shown
- ✅ Elegant presentation maintained

**What's Shown:**
- ✅ Menu item name
- ✅ Description
- ✅ High-quality food photos
- ✅ Availability status (badge)
- ✅ "View Details" button (for available items)
- ✅ "Currently Unavailable" button (for sold-out items)

### Restaurant Application (Internal Use)
**Location:** `Restaurant /src/main/resources/fxml/MenuManagement.fxml`

**Full Pricing Functionality:**
- ✅ Prices displayed in menu management
- ✅ Prices shown on order invoices
- ✅ Staff can view all pricing information
- ✅ Billing calculations use database prices
- ✅ No changes to Restaurant POS functionality

## Rationale

### Why Remove Prices from Web App?

**1. Upscale Hotel Image**
- High-end establishments often avoid displaying prices publicly
- Creates an exclusive, luxury atmosphere
- Focuses guest attention on quality and experience

**2. Pricing Flexibility**
- Prices can be adjusted without updating website
- Different pricing for room service vs restaurant
- Seasonal or promotional pricing easier to manage

**3. Guest Experience**
- Reduces price sensitivity
- Encourages guests to inquire (personal interaction)
- Focuses on food quality and presentation

**4. Industry Standard**
- Common practice for luxury hotels
- Aligns with 5-star hotel expectations
- Professional presentation

### Why Keep Prices in Restaurant App?

**1. Operational Necessity**
- Staff need prices for order processing
- Billing requires accurate pricing
- Inventory management uses cost data

**2. Internal Tool**
- Not customer-facing
- Professional efficiency
- Accurate invoicing

## Technical Details

### Database
**No Changes Required:**
```sql
-- Prices still stored in database
SELECT item_id, name, price, available FROM menu_items;
```

The `price` column remains unchanged and fully functional.

### Web Application Changes

**Before:**
```blade
<div class="flex items-center justify-between pt-3 border-t">
    <span class="text-2xl font-bold text-gold-dark">
        LKR {{ number_format($item->price, 2) }}
    </span>
    <button class="...">Order</button>
</div>
```

**After:**
```blade
<div class="pt-3 border-t">
    <button class="w-full ...">
        View Details
    </button>
</div>
```

### Restaurant Application
**No Changes:**
- MenuManagement.fxml still displays prices
- OrderInvoicePreview.fxml still shows prices
- All billing functionality intact

## User Experience

### Web Application (Guests)

**Menu Card Display:**
```
┌─────────────────────────────┐
│     [Food Photo]            │
│     [Available Badge]       │
├─────────────────────────────┤
│ Chicken Spring Rolls        │
│ Crispy rolls with chicken   │
│ filling and vegetables      │
├─────────────────────────────┤
│   [View Details Button]     │
└─────────────────────────────┘
```

**Guest Flow:**
1. Browse menu with photos
2. See availability status
3. Click "View Details" to inquire
4. Contact restaurant for pricing/ordering

### Restaurant Application (Staff)

**Menu Management Display:**
```
┌──────────────────────────────────────┐
│ Item ID: M001                        │
│ Name: Chicken Spring Rolls           │
│ Category: APPETIZER                  │
│ Price: LKR 850.00          ← VISIBLE │
│ Available: ✓                         │
│ [Edit] [Delete]                      │
└──────────────────────────────────────┘
```

**Staff Flow:**
1. View full menu with prices
2. Take customer orders
3. Generate invoices with prices
4. Process payments accurately

## Button Changes

### Web Menu Buttons

**Available Items:**
```html
<button class="w-full bg-gold hover:bg-gold-dark text-white...">
    View Details
</button>
```
- Full-width for better visual balance
- Gold color (brand consistency)
- Hover effects maintained

**Unavailable Items:**
```html
<button disabled class="w-full bg-gray-300 text-gray-500...">
    Currently Unavailable
</button>
```
- Disabled state clearly visible
- Gray appearance indicates unavailable
- Cursor: not-allowed

## Future Enhancements

### Potential Additions:

**1. Inquiry Form**
- "View Details" could open modal
- Guest can request pricing via email
- Contact restaurant directly

**2. Room Service Integration**
- Logged-in guests see in-room pricing
- Different pricing for room service
- Direct ordering for hotel guests

**3. Special Offers**
- Highlight featured items
- "Chef's Special" badges
- Seasonal recommendations

**4. Detailed Descriptions**
- Click to see full ingredients
- Allergen information
- Preparation methods

## Access Levels

| User Type | Can See Prices? | Location |
|-----------|----------------|----------|
| **Public Website Visitors** | ❌ No | Web Application |
| **Hotel Guests (Logged Out)** | ❌ No | Web Application |
| **Hotel Guests (Logged In)** | ❌ No | Web Application |
| **Restaurant Staff** | ✅ Yes | Restaurant POS |
| **Reception Staff** | ✅ Yes | Reception POS (billing) |
| **Managers** | ✅ Yes | Manager Dashboard |

## Benefits

### For Guests:
- ✅ More elegant browsing experience
- ✅ Focus on food quality and presentation
- ✅ Less price-driven decision making
- ✅ Upscale atmosphere

### For Hotel:
- ✅ Premium brand positioning
- ✅ Flexibility in pricing strategy
- ✅ Encourages personal interaction
- ✅ Industry-standard presentation

### For Staff:
- ✅ Full access to all pricing
- ✅ Efficient order processing
- ✅ Accurate billing
- ✅ No operational changes

## Testing

### Web Application
1. Visit: `http://127.0.0.1:8000/menu`
2. Verify: No prices displayed on menu cards
3. Verify: "View Details" button shows for available items
4. Verify: Food photos and descriptions visible
5. Verify: Availability badges working

### Restaurant Application
1. Open Restaurant POS
2. Navigate to Menu Management
3. Verify: Prices displayed for all items
4. Create test order
5. Verify: Invoice shows prices correctly
6. Verify: Billing calculations accurate

### Database
```sql
-- Confirm prices still exist
SELECT COUNT(*) as items_with_prices 
FROM menu_items 
WHERE price IS NOT NULL AND price > 0;
```

## Rollback (If Needed)

To restore price display on web application:

```blade
<!-- Add back to menu card -->
<div class="flex items-center justify-between pt-3 border-t">
    <span class="text-2xl font-bold text-gold-dark">
        LKR {{ number_format($item->price, 2) }}
    </span>
    <button class="...">Order</button>
</div>
```

Then run:
```bash
php artisan view:clear
```

## Notes

- Prices stored in database remain unchanged
- Restaurant POS functionality completely preserved
- Common practice for luxury hospitality
- Aligns with hotel's upscale positioning
- No impact on operational workflows

---

**Status:** ✅ Implemented
**Last Updated:** December 3, 2025
**Affects:** Web Application menu display only
**Does Not Affect:** Restaurant POS, Reception POS, Manager Dashboard














































































