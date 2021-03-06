Dailymotion API
===============

**This API is not official**

-------------------------------------------

To initialize the class:
```php
$d = new Dailymotion('xllyx8');
```

The argument upon initialization of the class is the ID of the video

-------------------------------------------
![ID video](http://i.imgur.com/LXgOJ.png "ID video")

-------------------------------------------

### The list of functions to get information about the video

Url of the preview image
```php
$d->getVideoPreviewUrl();
```

ID of the video
```php
$d->getVideoId();
```

Title of video
```php
$d->getVideoTitle();
```

Description of the video
```php
$d->getVideoDescription();
```

Tags of the video
```php
$d->getVideoTags();
```

Dailymotion url of the video
```php
$d->getVideoUniqueUrl();
```

Owner login on the video
```php
$d->getVideoOwnerLogin();
```

Language of video
```php
$d->getVideoLang();
```

Date of sending the video
```php
$d->getVideoUploadDateTime();
```

Length of video (in seconds)
```php
$d->getVideoDuration();
```

Category of video
```php
$d->getVideoCategory();
```

Url to the video file (medium quality)
```php
$d->getSdMediaUrl();
```

Url to the video file (High Quality)
```php
$d->getHdMediaUrl();
```

Url to the video file (High Quality 720p)
```php
$d->getHd720MediaUrl();
```

Url to the video file (High Quality 1080p)
```php
$d->getHd1080MediaUrl();
```

Url to the video file of better quality
```php
$d->getBestQuality();
```

-------------------------------------------

### List of tools at your disposal

Force download of a video
```php
$d->downloadVideo($d->getBestQuality());
```

Converted the duration of the video (in seconds) in minutes
```php
$d->getVideoTimeConverted();
```

Converted the date to upload in relative date
```php
$d->getVideoUploadDateTimeRelative();
```

Adding a logo "play" in the preview image, the logo should be in PNG format !
```php
$d->insertPlayImage('http://i.imgur.com/kGfSq.png');
```


