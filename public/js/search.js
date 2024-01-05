$(function() {
  console.log('あああ');
    $('#search-btn').on('click',function(event) {
        event.preventDefault();//フォームの通常の通信キャンセル
        console.log('いいい');
        $.ajax({
          type: "get",
          URL: "/search",
          datatype: "html",
          data: {
            'keyword': $('#keyword').val(),
            'company_id': $('#company_id').val(),
            'minPrice' : $( 'minPrice').val(),
            'maxPrice' : $( 'maxPrice').val(),
            'minStock' : $( 'minStock').val(),
            'maxStock' : $( 'maxStock').val(),

          }
        })//通信成功時の処理
      .done((response) => {
        let newtable=$(response).find('#step7table')
        $('#step7table').html(newtable)
      
    })         
      .fail((error) => {
        console.log('失敗');
      }); 
    });
  });