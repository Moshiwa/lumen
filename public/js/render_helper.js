$(document).ready(function () {
    let that = new RenderHelper();

    that.randomColorGeneration($('.random-color'));

});

class RenderHelper
{
    randomColorGeneration($elems) {
        if ($elems.length === 0) {
            console.error('RenderHelper.randomColorGeneration elem is empty')
            return false;
        }

        $elems.each(function (index, elem) {
            let $elem = $(elem);
            let min = 0;
            let max = 240;
            let red = Math.floor(min + Math.random() * (max + 1 - min));
            let green = Math.floor(min + Math.random() * (max + 1 - min));
            let blue = Math.floor(min + Math.random() * (max + 1 - min));

            $elem.css({'background': `rgb(${red},${green},${blue})`});
        });

        return true;
    }

}
