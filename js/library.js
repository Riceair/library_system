//設定類別選取的DropDown內元素
let select_category = -1 //當前選的類別(All category=-1)
let CategoryDropdownBox = document.getElementById("category_dropdown_box"); //容器
let dropdown_template = document.querySelector("#category_dropdown_box li"); //下拉式元件(樣板) All category

for(let i=0;i<category_list.length;i++){
    let dropdown_item = dropdown_template.cloneNode(true)
    dropdown_item.childNodes[0].textContent = category_list[i][CANAME] //複製類別下拉式元件樣板
    dropdown_item.addEventListener('click',function(){ //加入點擊動作
        document.getElementById("category_dropdownMenu").textContent = category_list[i][CANAME]
        select_category = category_list[i][CAID]
    })
    CategoryDropdownBox.appendChild(dropdown_item) //加入容器
}
dropdown_template.addEventListener('click',function(){ //樣板加入點擊動作
    document.getElementById("category_dropdownMenu").textContent = dropdown_template.childNodes[0].textContent
    select_category = -1
})
//  Section end //

//設定查詢到的書
let BookBox = document.getElementById("book_box") //裝書的容器
let notborrow_template = document.querySelector(".NotBorrowed") //尚未借閱的樣板
let borrowed_template = document.querySelector(".Borrowed") //已借閱的樣板(自己借的)
let notifyreturn_template = document.querySelector(".NotifyReturn") //別人借的樣板
let borrowed_id_list = [] //紀錄被借閱書的book_id
for(let borrowed_inf in borrowed_list){
    borrowed_id_list.push(borrowed_inf[BORROWED_BOOK_ID])
}

for(let i=0;i<book_list.length;i++){
    let book_item
    if(borrowed_list!==null){ //有書被借閱
        if(borrowed_id_list.includes(book_list[i][BOOK_ID_IDX])){ //當前的書為"被借閱的書"
            let borrowed_idx = borrowed_id_list.indexOf(book_list[i][BOOK_ID_IDX])
            let borrow_account = borrowed_list[borrowed_idx][BORROWED_ACCOUNT]
            if(borrow_account===user_account){ //當前的書為使用者(本人)借的
                book_item = borrowed_template.cloneNode(true)
            }
            else{ //當前的書為其他人借的
                book_item = borrowed_template.cloneNode(true)
            }
        }
        else{
            book_item = notifyreturn_template.cloneNode(true)
        }
    }
    else{ //沒有書被借閱
        book_item = notborrow_template.cloneNode(true)
    }
    
    book_item.querySelector(".book_name").textContent = book_list[i][BOOK_NAME_IDX] //設定書名
    book_item.querySelector(".book_more").textContent = "作者:"+book_list[i][AUTHOR_IDX]+"  出版項:"+book_list[i][PUB_IDX]+"  類別:"+book_list[i][BOOK_CANAME_IDX]
    book_item.classList.remove("hidden") //去除隱藏
    BookBox.appendChild(book_item) //加入容器
}
// Section end //