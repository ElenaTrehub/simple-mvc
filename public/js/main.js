$(function () {
    let images = [];
    let numberItem = 0;

    //if($("#current-page")){
        //console.log($("#current-page"));
        //let url = $("#current-page").files.item(0);
        //images.push(url);
    //}

    function readURL(input) {

        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                let img = $('<img id="image" src="#" alt="" />');
                img.attr('src', e.target.result);
                img.width('120px');
                img.height('auto');



                let block = $('<div class="show"></div>');
                block.css('marginRight', '8px');
                block.css('position', 'relative');
                block.append(img);

                let del = $('<img src="../public/images/delete.png" alt="" />');
                del.css('position', 'absolute');
                del.css('z-index', '100');
                del.width('24px');
                del.height('24px');
                del.css('background-color', 'rgba(0, 0, 0, 0.5)');
                del.css('bottom', '8px');
                del.css('right', '4px');
                del.css('padding', '7px 7px 5px 7px');
                del.css('box-sizing', 'border-box');
                del.css('border-radius', '3px');
                del.css('cursor', 'pointer');
                del.attr('numberBlock', numberItem);
                numberItem++;
                del.on('click', function () {
                    delete images[del.attr('numberBlock')];
                    block.remove();
                });


                block.append(del);
                $(".template-add").prepend(block);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#del").on('click',function(){
        $("#del").parent().remove();
        console.log(this);
    });
    $("#photo").on('change',function(){

        //let ext = $("#photo").val().substring($("#photo").val().lastIndexOf('\\'));
        //let url = ext.substr(1);
        let url = this.files.item(0);
        images.push(url);
        readURL(this);

    });
    $("#number").on('change',function(){
        //console.log("123");
        let number = $("#number").val();

        let str = 'https://design' + number + '.horoshop.ua/';
        $("#link").val(str);
    });

    $("#remove_new").on('click', function () {
        $("#link").val('');
        $("#number").val('');
        $("#title").val('');
        $("#photo").val('');

        let blocks = $(".show");
        let count = blocks.length;
        for(let i=0; i<count; i++){
            blocks[i].remove();
        }
    });

    $('#AddButton').on( 'click', async function ( ){

        const extentions = [
            '.JPG',
            '.jpg',
            '.jpeg',
            '.png'
        ];

        let title = $('#title').val();
        let number = $('#number').val();
        let link = $('#link').val();


        if(/^[а-яa-z0-9\s]{3,50}$/i.test(title) === false ){

           alert('Название шаблона некорректно!');

        }//if

        if(/^[0-9]{1,9}$/.test(number) === false ){

            alert('Номер шаблона некорректен!');

        }//if



        let templateData = new FormData();
        templateData.append('title' , title);
        templateData.append('number' , number);





        $.each(images, function (key, value) {
            templateData.append(key, value);
        });

        console.log(templateData.values());

        try{

            let response = await $.ajax({
                url: 'template/addTemplate',
                method: 'POST',
                enctype: "multipart/form-data",
                contentType: false,
                processData: false,
                data: templateData
            });

            if( +response.code === 200 ){

                alert('Ваш шаблон успешно сохранен!');
                $(location).attr('href', '/homepage');
            }//if
            else{

                alert('Не удалось сохранить шаблон!');

                $(location).attr('href', '/homepage')
            }//else

        }//try
        catch( ex ){

            console.log(ex);

        }//catch

    });

    $('#UpdateButton').on( 'click', async function ( ){

        const extentions = [
            '.JPG',
            '.jpg',
            '.jpeg',
            '.png'
        ];

        let title = $('#title').val();
        let number = $('#number').val();
        let link = $('#link').val();
        let id = $('#id').val();

        if(/^[а-яa-z0-9\s]{3,50}$/i.test(title) === false ){

            alert('Название шаблона некорректно!');

        }//if

        if(/^[0-9]{1,9}$/.test(number) === false ){

            alert('Номер шаблона некорректен!');

        }//if



        let templateData = new FormData();
        templateData.append('title' , title);
        templateData.append('number' , number);
        templateData.append('templateId' , id);




        $.each(images, function (key, value) {
            templateData.append(key, value);
        });



        try{

            let response = await $.ajax({
                url: '/template/updateTemplate',
                method: 'POST',
                enctype: "multipart/form-data",
                contentType: false,
                processData: false,
                data: templateData
            });
console.log(response);
            if( +response.code === 200 ){

                alert('Ваш шаблон успешно обновлен!');
                //$(location).attr('href', '/homepage');
            }//if
            else{

                alert('Не удалось обновить шаблон!');

                //$(location).attr('href', '/homepage')
            }//else

        }//try
        catch( ex ){

            console.log(ex);

        }//catch

    });

});

