
//htmlを読み込んだ後
$(function() {
  loadSort();
  console.log('あああ');
    $('#search-btn').on('click',function(event) {
        event.preventDefault();//フォームの通常の通信キャンセル
        console.log('いいい');
                var keyword = $('#keyword').val();
                var company_id = $('#company_id').val();
                var minPrice = $('#minPrice').val();
                var maxPrice = $('#maxPrice').val();
                var minStock = $('#minStock').val();
                var maxStock = $('#maxStock').val();
                console.log(keyword);
                console.log(company_id);
                console.log(minPrice);
                console.log(maxPrice);
                console.log(minStock);
                console.log(maxStock);

         $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          type: "GET",
          URL: "search",
          datatype: "html",
          data:{
              keyword: keyword,
              company_id: company_id,
              minPrice: minPrice,
              maxPrice: maxPrice,
              minStock: minStock,
              maxStock: maxStock
            }                 
        })
           
       .done(function(data){
          console.log('ううう');
          let newtable = $(data).find('#step7table')
          $('#step7table').replaceWith(newtable);
          loadSort();

        })
           

    

      .fail((error) => {
        console.log('失敗');
        alert('失敗');
      }); 
      });
      });


  function loadSort(){ $(document).ready(function() {
    $('#fav-table').tablesorter();
    })}


   //削除機能 
    $(function() {
      $(".btn-dell").on("click", function (e) {
        e.preventDefault();
        console.log("削除");
        var deleteMessage = confirm('削除してよろしいでしょうか？');
        if(deleteMessage == true) {
          //var blog_element = $(this).parents('.content');
          // var blog_id = blog_element.attr("data-blog-id");
          
          var clickEle = $(this)
          var productID = clickEle.attr("data-user_id");

          // var url = location.href + "/" + productID;
          console.log('あいう');
          
        $.ajax({
          // url: url,
          type: 'POST',
          url: 'list/delete/'+productID, //userID にはレコードのIDが代入されています
          data: {'id': productID,
          '_method': 'DELETE'} ,
          dataType: 'json'
        })
        //”削除しても良いですか”のメッセージで”いいえ”を選択すると次に進み処理がキャンセルされます
        } else {
          (function(e) {
            e.preventDefault()
          })

        .done(function(data) {
          blog_element.remove();
        })



        





    
        .fail(function() {
          alert('blog destroy error');
        })
      }
      });
    }); 