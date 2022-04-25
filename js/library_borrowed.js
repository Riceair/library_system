function runBorrowedMode(){
    let BookBox = document.getElementById("book_box") //裝書的容器
    let borrow_return_template = document.querySelector(".BorrowReturn") //尚未借閱的樣板

    if(book_list!==null){
        for(let i=0;i<book_list.length;i++){
            book_item = borrow_return_template.cloneNode(true)
            book_item.classList.add("book_item")

            let book_others = book_item.querySelectorAll('.book_other')
            book_others[0].textContent = book_list[i][BORROW_DATE_IDX] //顯示借閱時間
            if(book_list[i][RETURN_DATE_IDX]!==null){ //已經歸還，顯示歸還時間
                book_others[1].textContent = book_list[i][RETURN_DATE_IDX]
            }
            else{
                //還沒歸還，顯示歸還按鈕
                let return_btn = document.createElement("button")
                return_btn.classList.add("btn")
                return_btn.classList.add("btn-danger")
                return_btn.textContent = "歸還"
                return_btn.addEventListener('click',function(){ //click 執行BookReturn.php(還書)
                    document.location.href="../php/BookReturn.php?bid="+book_list[i][BORROW_BID_IDX]
                })
                book_others[1].textContent = ""
                book_others[1].appendChild(return_btn)
            }
            
            book_item.querySelector(".book_name").textContent = book_list[i][BOOK_NAME_IDX] //設定書名
            book_item.querySelector(".book_more").textContent = "作者:"+book_list[i][AUTHOR_IDX]+"  出版項:"+book_list[i][PUB_IDX]+"  類別:"+book_list[i][BOOK_CANAME_IDX]
            book_item.classList.remove("hidden") //去除隱藏
            BookBox.appendChild(book_item) //加入容器
        }
    }
    else{
        document.getElementById("NoData").classList.remove("hidden")
    }
}