function runSearchMode(){

    // 設定類別選取的DropDown內元素 //
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
    document.getElementById("search_btn").addEventListener('click',function(){ //綁定search按鈕
        let search = document.getElementById("search_input").value
        document.location.href="library.php?search="+search+"&category="+select_category
    })
    //  Section end //

    // 設定查詢到的書 //
    let BookBox = document.getElementById("book_box") //裝書的容器
    let notborrow_template = document.querySelector(".NotBorrowed") //尚未借閱的樣板
    let borrowed_template = document.querySelector(".Borrowed") //已借閱的樣板(自己借的)
    let notifyreturn_template = document.querySelector(".NotifyReturn") //別人借的樣板
    let borrowed_id_list = [] //紀錄被借閱書的book_id
    if(borrowed_list!==null){
        for(let i=0;i<borrowed_list.length;i++){ //紀錄被借閱書的book_id
            borrowed_id_list.push(borrowed_list[i][BORROWED_BOOK_ID])
        }
    }

    if(book_list!==null){
        for(let i=0;i<book_list.length;i++){
            let book_item
            if(borrowed_list!==null){ //有書被借閱
                if(borrowed_id_list.includes(book_list[i][BOOK_ID_IDX])){ //當前的書為"被借閱的書"
                    let borrowed_idx = borrowed_id_list.indexOf(book_list[i][BOOK_ID_IDX]) //"被借閱的書"的書id
                    let borrowed_bid = borrowed_list[borrowed_idx][BORROWED_ID] //"被借閱的書"的借書紀錄(borrow_list)的id
                    let borrow_account = borrowed_list[borrowed_idx][BORROWED_ACCOUNT] //借書的帳號
                    if(borrow_account===user_account){ //當前的書為使用者(本人)借的
                        book_item = borrowed_template.cloneNode(true)
                        book_item.querySelector(".btn").addEventListener('click',function(){ //click 執行BookReturn.php(還書)
                            document.location.href="../php/BookReturn.php?bid="+borrowed_bid
                        })
                    }
                    else{ //當前的書為其他人借的
                        book_item = notifyreturn_template.cloneNode(true)
                        book_item.querySelector(".btn").addEventListener('click',function(){ //click 執行BookNotify.php(還書)
                            document.location.href="../php/BookNotify.php?bid="+borrowed_bid
                        })
                    }
                }
                else{ //當前的書沒有被借閱
                    book_item = notborrow_template.cloneNode(true)
                    book_item.querySelector(".btn").addEventListener('click',function(){ //click 執行BookBorrow.php(借書)
                        document.location.href="../php/BookBorrow.php?book_id="+book_list[i][BOOK_ID_IDX]
                    })
                }
            }
            else{ //沒有書被借閱
                book_item = notborrow_template.cloneNode(true)
                book_item.querySelector(".btn").addEventListener('click',function(){ //click 執行BookBorrow.php(借書)
                    document.location.href="../php/BookBorrow.php?book_id="+book_list[i][BOOK_ID_IDX]
                })
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
    // Section end //

}