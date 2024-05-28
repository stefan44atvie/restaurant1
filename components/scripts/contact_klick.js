function contact_onklick(i){
    var content = document.getElementById(i);
    var content1 = document.getElementById('address_inhalt');
    var content2 = document.getElementById('anfahrt_inhalt');
    var content3 = document.getElementById('openhours_inhalt');
    // var content4 = document.getElementById('contact_inhalt');

    // var btns = document.getElementsByClassName("btn");
    // var btn1 = document.getElementById('table1');

   
    if(content1.style.display='block'){
        content1.style.display='none';
    }else{
        content(i).style.display='block';
    }
    if(content2.style.display='block'){
        content2.style.display='none';
    }else{
        content(i).style.display='block';
    }
    if(content3.style.display='block'){
        content3.style.display='none';
    }else{
        content(i).style.display='block';
    }
    // if(content4.style.display='block'){
    //     content4.style.display='none';
    // }else{
    //     content(i).style.display='block';
    // }
    content.style.display='block';
}

