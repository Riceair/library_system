//切換Mode按鈕
let mode_btns = document.querySelectorAll(".nav-link")
for(let i=0;i<mode_btns.length;i++){
    mode_btns[i].addEventListener('click',function(){
        document.location.href="library.php?mode="+i
    })
}

//登出按鈕


//Mode
if(parseInt(mode)===SEARCH_MODE){
    document.getElementById("search_section").classList.remove("hidden")
    document.querySelectorAll(".nav-link")[SEARCH_MODE].classList.add("active")
    runSearchMode()
}