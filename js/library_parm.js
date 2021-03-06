//從資料庫Query來的書本index
/*  
    SELECT book.*, book_category.category
    FROM book, book_category
    WHERE book.book_caid=book_category.caid
*/
const BOOK_ID_IDX = 0 //書本id
const AUTHOR_IDX = 1
const BOOK_NAME_IDX = 2
const PUB_IDX = 3
const BOOK_CAID_IDX = 4
const BOOK_CANAME_IDX = 5
//借閱紀錄多的欄位
const BORROW_BID_IDX = 6
const BORROW_DATE_IDX = 7
const RETURN_DATE_IDX = 8

//從資料庫Query來的類別
// SELECT * FROM book_category
const CAID = 0
const CANAME = 1

//從資料庫Query來的"被借閱的書"
const BORROWED_ID = 0
const BORROWED_BOOK_ID = 1
const BORROWED_ACCOUNT = 2

//網頁MODE
const SEARCH_MODE = 0
const BORROWED_MODE = 1
const MANAGE_MODE = 2
const SETTING_MODE = 3