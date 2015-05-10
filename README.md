# Hackathon_S3Bucket

## Project Goals

* Ability to sync product images and possibly other media assets to AWS S3 Bucket
* Selectively sync images when product is updated
* Hook into images cache warm-up process and sync directly to S3
* Displaying bucket stats (size, number of files) in the admin panel

## Known Issues

* [AWS S3 Library](https://github.com/tpyo/amazon-s3-php-class) currently doesn't support V4 auth e.g. for Frankfurt region (see [issue](https://github.com/tpyo/amazon-s3-php-class/issues/96))

## Support
 
If you have any issues with this extension, open an issue on [GitHub](https://github.com/magento-hackathon/Hackathon_S3Bucket/issues).
 
## Contribution
 
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://github.com/magento-hackathon/Hackathon_S3Bucket/pulls)
 
# Developers
 
* @andreasemer
* @Zifius
 
## License
 
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)
