function klickme(i){
    var content = document.getElementById(i);
    var content1 = document.getElementById('openhours_field');
    var content2 = document.getElementById('contact_field');
    // var btns = document.getElementsByClassName("btn");
    // var btn1 = document.getElementById('table1');


    if(content1.style.display='block'){
        content1.style.display='none';
        // btn1.classList.add("active");
        // btn(y).className.replace =("active", "");

    }else{
        content(i).style.display='block';
        content1.style.display='block';

    }
    if(content2.style.display='block'){
        content2.style.display='none';
    }else{
        content(i).style.display='block';

    }
    content.style.display='block';
    // document.getElementById(i).classList.add("active");
    // btn1.classList.add("active");
    // btns(i).className += "active";
    // btns[i].className = "active";

    // btns[i].classname.replace("active", "");
    // btn1.className += "active";

    // document.getElementById(y).className ="active";
    // this.className += "active";
    // document.getElementById(!i).style.display='none';

}