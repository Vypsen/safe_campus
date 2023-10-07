$(document).ready(function () {
    corpuses = ['AES', 'IMCT', 'PI', 'IHTAM', 'TOISRIS', 'IWO', 'SMLS', 'SEM', 'SL', 'SAH', 'SE'];
    corpuses_ru = {'AES': ['ПИШ'], 'IMCT' : ['ИМКТ'], 'PI' : ["ПИ"], 'IHTAM' : ["ИНТИПМ"], 'TOISRIS': ["ВИШРМИ"], 'IWO' : ["ИМО"], 'SMLS': ["ШМ"], 'SEM': ["ШЭМ"], 'SL': ["ЮШ"], 'SAH': ["ШИГН"], 'SE':["ШП"]};
    dots = {
        'AES': [1128, 260],
        'IMCT': [1326, 260],
        'PI': [436, 334],
        'IHTAM': [1669, 162],
        'TOISRIS': [1128, 510],
        'IWO' : [1326, 510],
        'SMLS': [866, 105],
        'SEM': [1725, 484],
        'SL': [1542, 425],
        'SAH': [50, 472],
        'SE': [243, 394]
    }
    count = 0
    $('.school').each(function() {
        $(this).addClass(corpuses[count]);
        $(this).css('left', String(dots[corpuses[count]][0]+20)+'px');
        $(this).css('top', String(dots[corpuses[count]][1]-50)+'px');
        $(this).find('img').attr('src', 'storage/'+corpuses[count]+'.png' );
        $(this).find('span').text(corpuses_ru[corpuses[count]][0]);
        count+=1
    })

    $(".school_btn").hover(function(){
        $(this).parent().find('.caption_school').first().css("opacity", 1);
        $(this).parent().find('.caption_school').first().css("transform", 'scale(1.1)');
    }, function(){
        $(this).parent().find('.caption_school').first().css("opacity", 0);
        $(this).parent().find('.caption_school').first().css("transform", 'scale(1.0)');
    });
})
