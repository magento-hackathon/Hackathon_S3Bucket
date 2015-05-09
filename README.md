# Hackathon_S3Bucket

## Project Goals:

* Ability to sync product images and possibly other media assets to AWS S3 Bucket
* Selectively sync images when product is updated
* Hook into images cache warmup proccess and sync directly to S3
* Displaying current bucket name in the admin panel

## Known Issues

* [url=https://github.com/tpyo/amazon-s3-php-class]AWS S3 Library[/url] currently doesn't support v4 auth e.g. for Frankfurt region (see [url=https://github.com/tpyo/amazon-s3-php-class/issues/96]issue[/url] 
