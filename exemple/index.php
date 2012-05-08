<?php
include "../dailymotion.class.php";
$d = new Dailymotion("xllyx8");
?>
<script type='text/javascript' src='player/jwplayer.js'></script>
 
<div id='mediaspace'></div>
 
<script type='text/javascript'>
  jwplayer('mediaspace').setup({
    'flashplayer': 'player/player.swf',
    'file': '<?php echo $d->getSdMediaUrl(); ?>',
    'controlbar': 'bottom',
    'skin': 'player/newtubedark.zip',
    'width': '470',
    'height': '320',
    'image': '<?php echo $d->getVideoPreviewUrl(); ?>',
    'plugins': {
       'hd-2': {
           'file': '<?php echo $d->getBestQuality(); ?>'
       }
   }

  });
</script>