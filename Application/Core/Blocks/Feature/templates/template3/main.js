let selectortitle3 = '/*page*/ .feature__title';
if(document.querySelector(selectortitle3)){

    let featureTitle =  document.querySelector(selectortitle3);
    /*feature_h_c*/
}
let featureItems3 = '/*page*/ .feature-item';
if(document.querySelectorAll(featureItems3)){
    let featureItems = document.querySelectorAll('.feature-item');

    getFeatureItemsHeight(featureItems);

    function getFeatureItemsHeight(items){
        let minHeight = items[0].clientHeight;

        for(let i = 1; i < items.length; i++){
            if(items[i].clientHeight > minHeight){
                minHeight = items[i].clientHeight;
            }
        }

        for(let i = 0; i < items.length; i++){
            items[i].style.minHeight = minHeight+'px';

        }
    }

    window.onresize = function(){
        getFeatureItemsHeight(featureItems);
    };
}



