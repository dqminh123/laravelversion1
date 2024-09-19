
** các bảng tham gia phân quyền 
+ user
+ user_Catalogues
+ user_catalogue_user : 1 nhóm thì sẽ có nhiều thành viên , ngược lại 1 thành viên thì có thể ở trong nhiều nhóm
+ permission : lưu quyền
+ user_catalogue_permission

** Nhân Bản
+ web
+ controller
+ model
+ repositori
+ services
+ config
+ request
+ view


** quan hệ ngôn ngữ giữa post và languages

bang post_catalogues va languages quan he n - n

nen no phat sinh bang pivot post_catalogue_language

nên trong PostCatalogue Model thi khai bao languages

trong languages khai bao post_catalogues

chứ ko được khai báo quan hệ vào bang pivot
