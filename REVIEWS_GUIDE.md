# How to Add Real Google Reviews

## Method 1: Manual Entry (Easiest)

1. **Open the reviews config file:**
   ```
   Web application/config/reviews.php
   ```

2. **Update the overall rating and total reviews:**
   ```php
   'overall_rating' => 4.9,  // Change to your actual rating
   'total_reviews' => 39,    // Change to your actual review count
   ```

3. **Add your real reviews:**
   Copy reviews from your Google Business Profile and add them in this format:
   ```php
   [
       'name' => 'Guest Name',           // Real guest name from Google
       'date' => '15/03/2023',           // Review date (DD/MM/YYYY format)
       'rating' => 5,                    // Star rating (1-5)
       'text' => 'Review text here...',  // Full review text
       'avatar' => 'G',                   // First letter of name
   ],
   ```

4. **Example:**
   ```php
   [
       'name' => 'John Smith',
       'date' => '20/01/2024',
       'rating' => 5,
       'text' => 'Amazing stay! The hotel exceeded all expectations. The staff was friendly, rooms were clean, and the location was perfect.',
       'avatar' => 'J',
   ],
   ```

5. **Save the file** - The reviews will automatically appear on your website!

## Method 2: Google Places API (Automatic)

If you want to automatically fetch reviews from Google, you'll need to:

1. **Get a Google Places API Key:**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Enable the Places API
   - Create an API key

2. **Install the required package:**
   ```bash
   composer require google/places-api
   ```

3. **Add your API key to `.env`:**
   ```
   GOOGLE_PLACES_API_KEY=your_api_key_here
   GOOGLE_PLACE_ID=your_place_id_here
   ```

4. **Create a service to fetch reviews** (I can help you set this up if needed)

## Tips

- **Copy reviews from Google:** Go to your Google Business Profile → Reviews section
- **Keep dates accurate:** Use the actual date from Google reviews
- **Preserve review text:** Copy the exact text to maintain authenticity
- **Use real names:** Only use names that appear in your actual Google reviews
- **Update regularly:** Add new reviews as they come in

## Where to Find Your Reviews

1. Go to [Google Business Profile](https://business.google.com/)
2. Select your business
3. Click on "Reviews" in the left menu
4. Copy the review details (name, date, rating, text)

## Notes

- The avatar will automatically use the first letter of the name
- Reviews are displayed in the order you add them in the config file
- You can add as many reviews as you want
- The carousel will automatically adjust to show 3 reviews at a time









