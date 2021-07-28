


    let featureItems = document.querySelectorAll('.feature-item');

    let featureTitle =  document.querySelector('.feature__title');
    /*feature_h_c*/



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

