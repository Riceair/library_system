//切換Mode按鈕
let mode_btns = document.querySelectorAll(".nav-link")
for(let i=0;i<mode_btns.length;i++){
    mode_btns[i].addEventListener('click',function(){
        document.location.href="library.php?mode="+i
    })
}

//登出按鈕
document.getElementById("sign_out").addEventListener('click',function(){
    document.location.href="../php/SignOut.php"
})

//Mode
if(parseInt(mode)===SEARCH_MODE){
    document.getElementById("search_section").classList.remove("hidden")
    document.querySelectorAll(".nav-link")[SEARCH_MODE].classList.add("active")
    runSearchMode()
}
else if(parseInt(mode)===BORROWED_MODE){
    document.getElementById("BorrowListTitle").classList.remove("hidden")
    document.querySelectorAll(".nav-link")[BORROWED_MODE].classList.add("active")
    runBorrowedMode()
}
else if(parseInt(mode)===MANAGE_MODE){
    document.getElementById("MangeModeSwitch").classList.remove("hidden")
    document.querySelectorAll(".nav-link")[MANAGE_MODE].classList.add("active")
    
    runAddMode() //先執行Add Mode

    let switchBtns = document.getElementById("MangeModeSwithGroup").querySelectorAll(".btn")
    switchBtns[0].addEventListener('click',function(){ //執行Add Mode
        switchBtns[0].classList.add("active")
        switchBtns[1].classList.remove("active")
        runAddMode()
    })
    switchBtns[1].addEventListener('click',function(){ //執行Delete Mode
        switchBtns[0].classList.remove("active")
        switchBtns[1].classList.add("active")
        runDeleteMode()
    })
}