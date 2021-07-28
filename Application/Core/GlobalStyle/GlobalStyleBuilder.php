<?php


namespace Application\Core\GlobalStyle;


class GlobalStyleBuilder
{
    public function getGlobalStyle($fonts, $spaces, $colors){

        $titleWeight = [ 300, 400,  500, 600];
        $indexWeight = rand(0, 3);

        $sectionStyle = '.section{padding: '.$spaces->sectionSpace.';}';
        $titleStr = '.title{font-weight:'.$titleWeight[$indexWeight].'; font-size: '.$fonts->h2Size.'; padding-bottom: '.$spaces->titleBottomSpace.';}';
        $titleLightColor = '.title-light{color: '.$colors->titleColor.';}';
        $titleDarkColor = '.title-dark{color: '.$colors->linkColor.';}';

        $globalStr = 'html{
  box-sizing: border-box;
}
*, *::before, *::after{
  box-sizing: inherit;
}
body{
  font-family: "'.$fonts->nameFont.'" , sans-serif;
  min-width: 320px;
  overflow-x: hidden;
}
a{
  display: inline-block;
  text-decoration: none;
}
ul,li{
  margin: 0;
  padding: 0;
  list-style: none;
}';


        return $globalStr.$sectionStyle.$titleStr.$titleLightColor.$titleDarkColor;

    }

}