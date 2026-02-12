# Menu Images Download Guide

## Overview
You have 48 menu items total, but only 2 have images. This guide helps you add professional food photography for all menu items.

## Menu Items Needing Images (46 items)

### APPETIZERS (6 items without images)
1. **M002 - Chicken Wings** → Search: "buffalo chicken wings restaurant plate"
2. **M003 - Caesar Salad** → Search: "caesar salad fresh romaine restaurant"
3. **M004 - Mozzarella Sticks** → Search: "mozzarella sticks marinara sauce"
4. **M005 - Onion Rings** → Search: "crispy onion rings restaurant"
5. **M006 - Chicken Satay** → Search: "chicken satay skewers peanut sauce"
6. **M007 - Prawn Cocktail** → Search: "prawn cocktail shrimp appetizer"

### MAIN COURSES (11 items without images)
1. **M008 - Grilled Chicken** → Search: "grilled chicken breast vegetables"
2. **M009 - Beef Steak** → Search: "beef steak grilled restaurant"
3. **M010 - Fish Curry** → Search: "sri lankan fish curry"
4. **M011 - Pasta Carbonara** → Search: "pasta carbonara creamy italian"
5. **M013 - Grilled Salmon** → Search: "grilled salmon fillet vegetables"
6. **M014 - Chicken Biryani** → Search: "chicken biryani indian rice"
7. **M015 - Pork Chops** → Search: "grilled pork chops restaurant"
8. **M016 - Vegetable Curry** → Search: "vegetable curry sri lankan"
9. **M017 - Lamb Curry** → Search: "lamb curry restaurant plate"
10. **M018 - Pizza Margherita** → Search: "pizza margherita fresh basil"
11. **M019 - Beef Burger** → Search: "gourmet beef burger restaurant"
12. **M020 - Spaghetti Bolognese** → Search: "spaghetti bolognese meat sauce"

### DESSERTS (8 items without images)
1. **M021 - Chocolate Cake** → Search: "chocolate cake slice restaurant"
2. **M022 - Ice Cream** → Search: "ice cream scoops dessert"
3. **M023 - Fruit Salad** → Search: "fresh fruit salad bowl"
4. **M024 - Cheesecake** → Search: "cheesecake slice strawberry"
5. **M025 - Chocolate Mousse** → Search: "chocolate mousse dessert glass"
6. **M026 - Apple Pie** → Search: "apple pie slice restaurant"
7. **M027 - Tiramisu** → Search: "tiramisu italian dessert"
8. **M028 - Panna Cotta** → Search: "panna cotta berry sauce"

### BEVERAGES (12 items without images)
1. **M029 - Soft Drinks** → Search: "soft drinks cola bottles"
2. **M030 - Fresh Juice** → Search: "fresh fruit juice glass"
3. **M031 - Coffee** → Search: "coffee cup espresso restaurant"
4. **M032 - Tea** → Search: "tea cup hot beverage"
5. **M033 - Fresh Orange Juice** → Search: "fresh orange juice glass"
6. **M034 - Mango Smoothie** → Search: "mango smoothie tropical drink"
7. **M035 - Mineral Water** → Search: "mineral water bottle glass"
8. **M036 - Fresh Lime Juice** → Search: "fresh lime juice mojito glass"
9. **M037 - Iced Tea** → Search: "iced tea lemon glass"
10. **M038 - Milkshake** → Search: "milkshake chocolate vanilla"
11. **M039 - Fresh Coconut Water** → Search: "fresh coconut water tropical"
12. **M040 - Hot Chocolate** → Search: "hot chocolate whipped cream"

### SNACKS (8 items without images)
1. **M041 - Sandwich** → Search: "club sandwich restaurant"
2. **M042 - French Fries** → Search: "french fries crispy golden"
3. **M043 - Chicken Nuggets** → Search: "chicken nuggets fried restaurant"
4. **M044 - Nachos** → Search: "nachos cheese jalapeno"
5. **M045 - Garlic Bread** → Search: "garlic bread butter restaurant"
6. **M046 - Onion Bhaji** → Search: "onion bhaji indian pakora"
7. **M047 - Fish & Chips** → Search: "fish and chips restaurant"
8. **M048 - Club Sandwich** → Search: "club sandwich triple decker"

## Step-by-Step Instructions

### Option 1: Manual Download (Recommended for Quality)

1. **Visit Free Stock Photo Sites:**
   - Pexels.com (free, high-quality)
   - Unsplash.com (free, high-quality)
   - Pixabay.com (free, commercial use)

2. **For Each Menu Item:**
   - Search using the provided search terms above
   - Download high-quality image (at least 1920x1080)
   - Save with format: `[ITEM_ID]_[timestamp].png`
     - Example: `M002_1764800000000.png` for Chicken Wings

3. **Place Images:**
   ```bash
   # Save all downloaded images to:
   /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/public/images/menu/
   ```

4. **Update Database:**
   Use the SQL commands in the next section

### Option 2: Quick Script (Placeholder for Testing)

I've created a script that generates placeholder commands for you. See `update_menu_images.sh` below.

## SQL Commands to Update Database

After downloading images, run these commands for each item:

```sql
-- Example for Chicken Wings (M002)
UPDATE menu_items 
SET image_path = 'images/menu/M002_1764800000000.png' 
WHERE item_id = 'M002';

-- Chicken Satay (M006)
UPDATE menu_items 
SET image_path = 'images/menu/M006_1764800000001.png' 
WHERE item_id = 'M006';

-- Repeat for all items...
```

Or use this bulk update script (after you have all images):

```sql
-- Update all APPETIZERS
UPDATE menu_items SET image_path = 'images/menu/M002_chicken_wings.png' WHERE item_id = 'M002';
UPDATE menu_items SET image_path = 'images/menu/M003_caesar_salad.png' WHERE item_id = 'M003';
UPDATE menu_items SET image_path = 'images/menu/M004_mozzarella_sticks.png' WHERE item_id = 'M004';
UPDATE menu_items SET image_path = 'images/menu/M005_onion_rings.png' WHERE item_id = 'M005';
UPDATE menu_items SET image_path = 'images/menu/M006_chicken_satay.png' WHERE item_id = 'M006';
UPDATE menu_items SET image_path = 'images/menu/M007_prawn_cocktail.png' WHERE item_id = 'M007';

-- Update all MAIN COURSES
UPDATE menu_items SET image_path = 'images/menu/M008_grilled_chicken.png' WHERE item_id = 'M008';
UPDATE menu_items SET image_path = 'images/menu/M009_beef_steak.png' WHERE item_id = 'M009';
UPDATE menu_items SET image_path = 'images/menu/M010_fish_curry.png' WHERE item_id = 'M010';
UPDATE menu_items SET image_path = 'images/menu/M011_pasta_carbonara.png' WHERE item_id = 'M011';
UPDATE menu_items SET image_path = 'images/menu/M013_grilled_salmon.png' WHERE item_id = 'M013';
UPDATE menu_items SET image_path = 'images/menu/M014_chicken_biryani.png' WHERE item_id = 'M014';
UPDATE menu_items SET image_path = 'images/menu/M015_pork_chops.png' WHERE item_id = 'M015';
UPDATE menu_items SET image_path = 'images/menu/M016_vegetable_curry.png' WHERE item_id = 'M016';
UPDATE menu_items SET image_path = 'images/menu/M017_lamb_curry.png' WHERE item_id = 'M017';
UPDATE menu_items SET image_path = 'images/menu/M018_pizza_margherita.png' WHERE item_id = 'M018';
UPDATE menu_items SET image_path = 'images/menu/M019_beef_burger.png' WHERE item_id = 'M019';
UPDATE menu_items SET image_path = 'images/menu/M020_spaghetti_bolognese.png' WHERE item_id = 'M020';

-- Update all DESSERTS
UPDATE menu_items SET image_path = 'images/menu/M021_chocolate_cake.png' WHERE item_id = 'M021';
UPDATE menu_items SET image_path = 'images/menu/M022_ice_cream.png' WHERE item_id = 'M022';
UPDATE menu_items SET image_path = 'images/menu/M023_fruit_salad.png' WHERE item_id = 'M023';
UPDATE menu_items SET image_path = 'images/menu/M024_cheesecake.png' WHERE item_id = 'M024';
UPDATE menu_items SET image_path = 'images/menu/M025_chocolate_mousse.png' WHERE item_id = 'M025';
UPDATE menu_items SET image_path = 'images/menu/M026_apple_pie.png' WHERE item_id = 'M026';
UPDATE menu_items SET image_path = 'images/menu/M027_tiramisu.png' WHERE item_id = 'M027';
UPDATE menu_items SET image_path = 'images/menu/M028_panna_cotta.png' WHERE item_id = 'M028';

-- Update all BEVERAGES
UPDATE menu_items SET image_path = 'images/menu/M029_soft_drinks.png' WHERE item_id = 'M029';
UPDATE menu_items SET image_path = 'images/menu/M030_fresh_juice.png' WHERE item_id = 'M030';
UPDATE menu_items SET image_path = 'images/menu/M031_coffee.png' WHERE item_id = 'M031';
UPDATE menu_items SET image_path = 'images/menu/M032_tea.png' WHERE item_id = 'M032';
UPDATE menu_items SET image_path = 'images/menu/M033_orange_juice.png' WHERE item_id = 'M033';
UPDATE menu_items SET image_path = 'images/menu/M034_mango_smoothie.png' WHERE item_id = 'M034';
UPDATE menu_items SET image_path = 'images/menu/M035_mineral_water.png' WHERE item_id = 'M035';
UPDATE menu_items SET image_path = 'images/menu/M036_lime_juice.png' WHERE item_id = 'M036';
UPDATE menu_items SET image_path = 'images/menu/M037_iced_tea.png' WHERE item_id = 'M037';
UPDATE menu_items SET image_path = 'images/menu/M038_milkshake.png' WHERE item_id = 'M038';
UPDATE menu_items SET image_path = 'images/menu/M039_coconut_water.png' WHERE item_id = 'M039';
UPDATE menu_items SET image_path = 'images/menu/M040_hot_chocolate.png' WHERE item_id = 'M040';

-- Update all SNACKS
UPDATE menu_items SET image_path = 'images/menu/M041_sandwich.png' WHERE item_id = 'M041';
UPDATE menu_items SET image_path = 'images/menu/M042_french_fries.png' WHERE item_id = 'M042';
UPDATE menu_items SET image_path = 'images/menu/M043_chicken_nuggets.png' WHERE item_id = 'M043';
UPDATE menu_items SET image_path = 'images/menu/M044_nachos.png' WHERE item_id = 'M044';
UPDATE menu_items SET image_path = 'images/menu/M045_garlic_bread.png' WHERE item_id = 'M045';
UPDATE menu_items SET image_path = 'images/menu/M046_onion_bhaji.png' WHERE item_id = 'M046';
UPDATE menu_items SET image_path = 'images/menu/M047_fish_chips.png' WHERE item_id = 'M047';
UPDATE menu_items SET image_path = 'images/menu/M048_club_sandwich.png' WHERE item_id = 'M048';
```

## Image Download Websites (Free, Commercial Use)

### Recommended Sites:
1. **Pexels.com** - Best quality, 100% free
2. **Unsplash.com** - High-res professional photos
3. **Pixabay.com** - Free stock photos

### Download Tips:
- Choose images at least 1920x1080 pixels
- Look for plated, restaurant-style presentation
- Avoid images with watermarks
- Download in JPG or PNG format
- Save with consistent naming: `[ITEM_ID]_[description].png`

## Naming Convention

Use this format for consistent organization:
```
M002_chicken_wings.png
M003_caesar_salad.png
M004_mozzarella_sticks.png
...etc
```

## Quick Process

### For Each Menu Item:

1. **Search** on Pexels/Unsplash using the search term above
2. **Download** the best image (high quality, restaurant-style)
3. **Rename** to match the format: `[ITEM_ID]_[name].png`
4. **Save** to: `Web application/public/images/menu/`
5. **Update database** using SQL command

### Example for Chicken Wings (M002):

```bash
# 1. Download image from Pexels.com (search "buffalo chicken wings")
# 2. Rename to: M002_chicken_wings.png
# 3. Move to menu folder:
mv ~/Downloads/chicken-wings-photo.jpg "/Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/public/images/menu/M002_chicken_wings.png"

# 4. Update database:
mysql -u root -p'Imaginedragons33624' hotel_db -e "UPDATE menu_items SET image_path = 'images/menu/M002_chicken_wings.png' WHERE item_id = 'M002';"
```

## Priority Order (Suggested)

### Phase 1: Main Courses (Most Important)
Start with main course items as they're ordered most frequently:
- Grilled Chicken, Beef Steak, Fish Curry, Pasta Carbonara, Grilled Salmon, Chicken Biryani, Pizza, Burger

### Phase 2: Appetizers
Popular starters:
- Chicken Wings, Caesar Salad, Mozzarella Sticks, Chicken Satay

### Phase 3: Desserts
Sweet finishes:
- Chocolate Cake, Ice Cream, Cheesecake, Tiramisu

### Phase 4: Beverages & Snacks
Supporting items

## Batch Update SQL

After downloading all images, use this single script:

```bash
mysql -u root -p'Imaginedragons33624' hotel_db << 'EOF'
-- Paste all UPDATE commands here at once
UPDATE menu_items SET image_path = 'images/menu/M002_chicken_wings.png' WHERE item_id = 'M002';
UPDATE menu_items SET image_path = 'images/menu/M003_caesar_salad.png' WHERE item_id = 'M003';
-- ... add all 46 items
EOF
```

## Alternative: AI-Generated Images

If you have access to AI image generators:
- DALL-E 3
- Midjourney
- Stable Diffusion

Use prompts like:
```
"Professional food photography of [item name], restaurant plating, 
high quality, well-lit, appetizing presentation, realistic"
```

## Verification After Adding Images

```sql
-- Check how many items have images
SELECT 
    category,
    COUNT(*) as total_items,
    SUM(CASE WHEN image_path IS NOT NULL THEN 1 ELSE 0 END) as items_with_images,
    ROUND(SUM(CASE WHEN image_path IS NOT NULL THEN 1 ELSE 0 END) / COUNT(*) * 100, 1) as coverage_percentage
FROM menu_items
GROUP BY category
ORDER BY category;
```

## Image Requirements

### Technical Specs:
- **Format**: PNG or JPG
- **Size**: 1920x1080 or higher
- **Aspect Ratio**: 16:9 or 4:3 preferred
- **File Size**: Under 5MB per image
- **Quality**: High resolution for zoom effects

### Content Guidelines:
- Professional food photography
- Restaurant-style plating
- Good lighting and composition
- No visible text or watermarks
- Focus on the dish (not environment)
- Appetizing presentation

## Current Status

**Menu Items with Images:** 2/48 (4%)
- ✅ M001 - Chicken Spring Rolls
- ✅ M012 - Fried Rice

**Menu Items Without Images:** 46/48 (96%)

**Target:** 100% coverage for professional menu presentation

## Time Estimate

- **Manual download**: ~2-3 minutes per image = ~2 hours for all 46
- **Database update**: ~5 minutes (batch SQL)
- **Total time**: ~2-2.5 hours for complete menu

## Benefits of Complete Image Coverage

### Customer Experience:
- ✅ Visual menu browsing
- ✅ Better ordering decisions
- ✅ Professional presentation
- ✅ Appetizing displays

### Business Benefits:
- ✅ Higher perceived value
- ✅ Increased order confidence
- ✅ Competitive advantage
- ✅ Modern restaurant image

---

## Need Help?

If you'd like, you can:
1. Download images gradually (start with main courses)
2. Use the Restaurant POS upload feature for individual items
3. Have your restaurant manager upload photos of actual dishes
4. Hire a food photographer for authentic hotel photos

The web application is ready to display images as soon as you add them!

---

**Current Coverage:** 2/48 items (4%)
**Target:** 48/48 items (100%)
**Status:** Ready to receive images














































































