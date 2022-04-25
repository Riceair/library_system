function runAddMode(){
    document.getElementById("AddBookForm").classList.remove("hidden") //顯示新增表單
    let BookBox = document.getElementById("book_box") //裝書的容器

    //刪除先前"刪除Mode"產生的內容
    let book_items = BookBox.querySelectorAll(".book_item")
    for(let i=0;i<book_items.length;i++){
        BookBox.removeChild(book_items[i])
    }


    //類別選項
    let category_select_box = document.getElementById("add_category")

    //刪除先前"新增Mode"產生的內容
    let option_items = category_select_box.querySelectorAll(".option_item")
    for(let i=0;i<option_items.length;i++){
        category_select_box.removeChild(option_items[i])
    }

    //產生"新增Mode"的option
    for(let i=0;i<category_list.length;i++){
        let select_option = document.createElement('option')
        select_option.classList.add("option_item")
        select_option.textContent = category_list[i][CANAME]
        category_select_box.appendChild(select_option)
    }
}

function runDeleteMode(){
    document.getElementById("AddBookForm").classList.add("hidden") //隱藏新增表單
    let BookBox = document.getElementById("book_box") //裝書的容器
    let deletebook_template = document.querySelector(".DeleteBook") //尚未借閱的樣板

    //刪除先前"刪除Mode"產生的內容
    let book_items = BookBox.querySelectorAll(".book_item")
    for(let i=0;i<book_items.length;i++){
        BookBox.removeChild(book_items[i])
    }

    if(book_list!==null){
        for(let i=0;i<book_list.length;i++){
            book_item = deletebook_template.cloneNode(true)
            book_item.classList.add("book_item")
            book_item.querySelector(".btn").addEventListener('click',function(){ //click 執行BookBorrow.php(借書)
                document.location.href="../php/BookDelete.php?book_id="+book_list[i][BOOK_ID_IDX]
            })
            
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