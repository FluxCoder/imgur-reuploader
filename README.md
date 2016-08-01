# PHP Imgur Image Reuploader

This PHP Script is a basic reuploader, here is what it does:
- User enters Image URL
- Downloads Image to local temp storage
- Uploads to Imgur via API
- Delete local temp storage Image.

# Temp Storage:
The Temporary storage folder is where the images are downloaded to, they are given a random name beginning with temp- then a few random numbers

# Preview
You can Preview the live version here: http://legitsources.cf/imgur.php

# Imgur Reuploader TinyAPI
Currently, I'm yet to finish the API for this script, as it's an API using an API, sounds strange I know :) All the API would be is a get request in the URL, something that's already built into the script, just not got a page for it yet. For now, just use host.com/imgur.php?url-http://exmaple.com/image.png

![Alt text](http://image.prntscr.com/image/1fa769fc2a8d42d38eeb872ae7c3bc73.png "User get's Imgur URL & Preview!")
