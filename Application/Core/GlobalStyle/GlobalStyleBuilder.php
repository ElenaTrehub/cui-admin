<?php


namespace Application\Core\GlobalStyle;


class GlobalStyleBuilder
{
    public function getGlobalStyle($fonts, $spaces, $colors){

        $titleWeight = [ 300, 400,  500, 600];
        $indexWeight = rand(0, 3);

        $textTransform = ['none', 'uppercase'];
        $index = rand(0, 2);

        $sectionStyle = '.section{padding: '.$spaces->sectionSpace.';}';
        $titleStr = '.title{font-weight:'.$titleWeight[$indexWeight].'; text-transform: '.$textTransform[$index].'; font-size: '.$fonts->h2Size.'; padding-bottom: '.$spaces->titleBottomSpace.';}';
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
  position: relative;
}
a{
  display: inline-block;
  text-decoration: none;
}
ul,li{
  margin: 0;
  padding: 0;
  list-style: none;
}
.fa, .fas, .far, .fal, .fad, .fab {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}
@font-face {
    font-family: "Font Awesome 5 Free";
    font-style: normal;
    font-weight: 900;
    font-display: block;
    src: url("../webfonts/fa-solid-900.eot");
    src: url("../webfonts/fa-solid-900.eot?#iefix") format("embedded-opentype"), url("../webfonts/fa-solid-900.woff2") format("woff2"), url("../webfonts/fa-solid-900.woff") format("woff"), url("../webfonts/fa-solid-900.ttf") format("truetype"), url("../webfonts/fa-solid-900.svg#fontawesome") format("svg"); }

.fa, .fas {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
}';

        $btnObj = $this->setButtonStyle($colors);
        $sliderButtonStyle = $this->setSliderButtonStyle($colors);


        return $globalStr.$sectionStyle.$titleStr.$titleLightColor.$titleDarkColor.$btnObj->buttonStr.$btnObj->buttonLightStr.$btnObj->buttonDarkStr.$btnObj->input.$btnObj->textarea.$sliderButtonStyle;

    }

    public function setSliderButtonStyle($colors){
        $buttonStr = '';

        $index = rand(0, 2);
        //$index = 1;
        switch ($index){
            case 0: {
                $buttonStr = "
                .slider-btn{
    opacity: .8;
    font-size: 28px;
    line-height: 24px;
    text-align: center;
    color: #ffffff;
    transition: all .5s ease;
    padding: 0;
    position: relative;
    width: 26px;
    height: 26px;
    border-radius: 13px;
    background-color: ".$colors->thirdBg.";
    outline: none;
    border: 2px solid #f1f2f3;
    box-sizing: border-box;

}
.slider-prev-btn:before{
    content:'\\2039';
    position: absolute;
    bottom: 2px;
    left: 6px;
}
.slider-next-btn:before{
    content:'\\203a';
    position: absolute;
    right: 6px;
    bottom: 2px;
}
.slider-btn:hover{
    opacity: 1;
    background-color: #f1f2f3;
    color: ".$colors->thirdBg.";
}                ";
                break;
            }
            case 1:{
                $buttonStr = "
                .slider-btn{
    opacity: .8;
    font-size: 28px;
    line-height: 24px;
    text-align: center;
    color: #ffffff;
    transition: all .5s ease;
    padding: 0;
    position: relative;
    width: 26px;
    height: 26px;
    background-color: ".$colors->thirdBg.";
    outline: none;
    border: none;
    box-sizing: border-box;

}
.slider-prev-btn:before{
    content:'\\2039';
    position: absolute;
    bottom: 3px;
    left: 0;
    right: 0;
}
.slider-next-btn:before{
    content:'\\203a';
    position: absolute;
    right: 0;
    left: 0;
    bottom: 3px;
}
.slider-btn:hover{
    opacity: 1;
    background-color: #f1f2f3;
    color: ".$colors->thirdBg.";
}                ";
                break;
            }
            case 2:{
                $buttonStr = "
                .slider-btn{
    opacity: .8;
    font-size: 16px;
    line-height: 24px;
    color: #ffffff;
    transition: all .5s ease;
    padding: 0;
    position: relative;
    width: 36px;
    height: 30px;
    background-color: ".$colors->thirdBg.";
    outline: none;
    border: 2px solid #f1f2f3;
    box-sizing: border-box;

}
.slider-prev-btn:before{
    content:'\\2190';
    text-align: center;
    position: absolute;
    bottom: 2px;
    left: 0;
    right: 0;
}
.slider-next-btn:before{
    content:'\\2192';
    text-align: center;
    position: absolute;
    right: 0;
    bottom: 2px;
    left: 0;
}
.slider-btn:hover{
    opacity: 1;
    background-color: #f1f2f3;
    color: ".$colors->thirdBg.";
}                ";
                break;
            }
        }
        return $buttonStr;

    }
    public function setButtonStyle($colors){

        $buttonStr = '';
        $inputStr = '';
        $textAreaStr = '';

        $buttonLightStr = '';
        $buttonDarkStr = '';

        $index = rand(0, 2);

        $blackBgColors = [$colors->mainBg, $colors->thirdBg];
        $blackBgColorsIndex = rand(0, 1);

        $mainBlackBg = $blackBgColors[$blackBgColorsIndex];
        if($mainBlackBg === $colors->mainBg){
            $mainBlackBgRgba = $colors->rgbaMainBg;
            $afterBlackBgRgba = $colors->rgbaThirdBg;
            $afterBlackBg = $colors->thirdBg;
        }
        else{
            $mainBlackBgRgba = $colors->rgbaThirdBg;
            $afterBlackBgRgba = $colors->rgbaMainBg;
            $afterBlackBg = $colors->mainBg;
        }


        $lightBgColors = [$colors->secondBg, '#f0f1f6'];
        $lightBgColorsIndex = rand(0, 1);

        $mainLightBg = $lightBgColors[$lightBgColorsIndex];
        if($mainLightBg === $colors->secondBg){
            $mainLightBgRgba = $colors->rgbaSecondBg;
            $afterLightRgba = '240, 241, 246';
            $afterLightBg = '#f0f1f6';
        }
        else{
            $mainLightBgRgba = '240, 241, 246';
            $afterLightRgba = $colors->rgbaSecondBg;
            $afterLightBg = $colors->secondBg;
        }



        switch ($index){
            case 0:{
                $buttonStr = '.button{
    display: inline-block;
	border: none;
	text-decoration: none;
	padding: 16px 45px;
	font-size: 13px;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 3px;
	border-radius: 3px;
	text-align: center;
	position: relative;
	outline: none;
	transition: background-color .1s ease;
                }
    .button::after{
    transition: background-color .1s ease;
		content: "";
		position: absolute;
		height: 4px;
		bottom: 0;
		width: 100%;
		opacity: .18;
		border-bottom-left-radius: 2px;
		border-bottom-right-radius: 2px;
		left: 0;
    }            
    .button:focus, .button:hover{
        text-decoration: none; 
    }        
        
    .button:hover .button::after{
        opacity: .22;
    }
      
    .button:active .button::after{
        opacity: .32;
    }        
                ';
                $inputStr = '.input{
    border-radius: 3px;
    border: none;
    padding: 10px;
                }
                .input:focus-visible{
    border: none;
    outline: none;
                }
                .input::placeholder{
    color: #555555;
                }';
                $textAreaStr = '.textarea{
    border-radius: 3px;
    border: none;
    padding: 10px;
                }
                .textarea:focus-visible{
    border: none;
    outline: none;
                }
                .textarea::placeholder{
    color: #555555;
                }';

                $buttonLightStr = '.button-light{
    color: #ffffff;
    background-color: '.$mainBlackBg.';
                }
    .button-light::after{
        background-color: '.$afterBlackBg.';
    }
    
    .button-light:hover{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }
    .button-light:active{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }  ';
                $buttonDarkStr = '.button-dark{
    color: '.$colors->mainBg.';
    background-color: '.$mainLightBg.';
                }
    .button-dark::after{
        background-color: '.$afterLightBg.';
    }
    
    .button-dark:hover{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }
    .button-dark:active{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }  ';


                break;
            }
            case 1:{
                $buttonStr = '.button{
    display: inline-block;
	border: none;
	text-decoration: none;
	padding: 16px 25px;
	font-size: 14px;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 3px;
	text-align: center;
	position: relative;
	outline: none;
	transition: background-color .1s ease;
                }
           
    .button:focus, .button:hover{
        text-decoration: none; 
    }     
                ';
                $inputStr = '.input{
    border-radius: none;
    border: none;
    padding: 10px;
                }
                .input:focus-visible{
    border: none;
    outline: none;
                }
                .input::placeholder{
    color: #555555;
    font-size: 14px;
                }';
                $textAreaStr = '.textarea{
    border-radius: none;
    border: none;
    padding: 10px;
                }
                .textarea:focus-visible{
    border: none;
    outline: none;
                }
                .textarea::placeholder{
    color: #555555;
    font-size: 14px;
                }';
                $buttonLightStr = '.button-light{
    color: #ffffff;
    background-color: '.$mainBlackBg.';
                }
   
    .button-light:hover{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }
    .button-light:active{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }  ';
                $buttonDarkStr = '.button-dark{
    color: '.$colors->mainBg.';
    background-color: '.$mainLightBg.';
                }
    .button-dark:hover{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }
    .button-dark:active{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }  ';

                break;
            }
            case 2:{
                $buttonStr = '.button{
    display: inline-block;
	border: none;
	text-decoration: none;
	padding: 18px 28px;
	font-size: 14px;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 3px;
	border-radius: 25px;
	text-align: center;
	position: relative;
	outline: none;
	transition: background-color .1s ease;
                }
           
    .button:focus, .button:hover{
        text-decoration: none; 
    }        
             
                ';
                $inputStr = '.input{
    border-radius: 18px;
    border: none;
    padding: 10px 20px;
                }
                .input:focus-visible{
    border: none;
    outline: none;
                }
                .input::placeholder{
    color: #555555;
    font-size: 14px;
                }';
                $textAreaStr = '.textarea{
    border-radius: 17px;
    border: none;
    padding: 10px;
                }
                .textarea:focus-visible{
    border: none;
    outline: none;
                }
                .textarea::placeholder{
    color: #555555;
    font-size: 14px;
                }';
                $buttonLightStr = '.button-light{
    color: #ffffff;
    background-color: '.$mainBlackBg.';
                }
    .button-light:hover{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }
    .button-light:active{
        background-color: rgba('.$mainBlackBgRgba.', .91);
    }  ';
                $buttonDarkStr = '.button-dark{
    color: '.$colors->mainBg.';
    background-color: '.$mainLightBg.';
                }
   
    .button-dark:hover{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }
    .button-dark:active{
        background-color: rgba('.$mainLightBgRgba.', .91);
    }  ';


                break;
            }

        }

        $buttonObj = new \stdClass();
        $buttonObj->buttonStr = $buttonStr;
        $buttonObj->buttonLightStr = $buttonLightStr;
        $buttonObj->buttonDarkStr = $buttonDarkStr;
        $buttonObj->input = $inputStr;
        $buttonObj->textarea = $textAreaStr;


        return $buttonObj;
    }

}