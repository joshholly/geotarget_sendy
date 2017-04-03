# geotarget_sendy
Create geo-targeted lists for Sendy. This will allow you to create lists based off of user's locations based on existing subscriber lists within Sendy.

HOW TO INSTALL:

1. Get an API key from zipcodeapi.com

2. Upload geo-segmentation.php and list.php to your main sendy directory. Overwrite the existing files

3. Open geo-add.php and place your zipcodeapi.com API key in the $api_key string.

4. Upload geo-add.php into the /includes/subscribers folder of your sendy directory. Overwrite the existing file

HOW TO USE:

1. When logged into Sendy, click "View All Lists"

2. Click "Create new list from geo segmentation.

3. Enter the name of the new list, select the parent list, add the zip code and the radius and create the list



REQUIREMENTS: 

Must have Sendy along with requirements installed. The parent list must have users with their zip codes added in the custom fields. 
