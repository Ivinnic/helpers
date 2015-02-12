/*
  @param String
    $filename - файл изображения
  @param String
    $text - текст для наложения
  @param String
    $font - файл шрифта (".ttf")
  @param Integer
    $size - размер шрифта
  @param Integer
    $r, $g, $b - цвет надписи (модель RGB)
  @param Integer
    $alpha - прозрачность (0 - не прозрачная, 127 - полностью прозрачная)
  @param String
    $template - шаблон вывода изображения в TPL
 */
public function makeTextWatermark($filename, $text, $font, $size = 1, $r = 128, $g = 128, $b = 128, $alpha = 80, $template = 'default') {
  $img = null;
  $inf = pathinfo($filename);
  $ext = $inf['extension'];
  $ext = strtolower($ext);
  if($ext == 'png')
    $img = imagecreatefrompng($filename);
  else
    $img = imagecreatefromjpeg($filename);
 
  $width = imagesx($img);
  $height = imagesy($img);
  $size = ((($width + $height) / 2) * $size / strlen($text));
 
  $angle = -rad2deg(atan2(-$height, $width));
 
  $box  = imagettfbbox ( $size, $angle, $font, $text );
  $x = $width/2 - abs($box[4] - $box[0])/2;
  $y = $height/2 + abs($box[5] - $box[1])/2;
 
  $color = imagecolorallocatealpha($img, $r, $g, $b, $alpha);
 
  imagettftext($img, $size, $angle, $x, $y, $color, $font, $text);
 
  $path = './images/cms/watermarks/';
  if(!file_exists($path))
    mkdir($path);
 
  $path .= $inf['basename'];
  imagepng($img, $path);
  imagedestroy($img);
 
  if(!$template)
    $template = 'default';
 
  list($image) =
    def_module::loadTemplates('watermarks/'.$template, 'image');
 
  $block_arr = array();
  $block_arr['filename'] = $path;
 
  return def_module::parseTemplate($image, $block_arr);
}
