
<!--
    When using the paginate() method in laravel,
    you can use the method links() to populate a bootstrap type pagination.

    And, because we are using a bootstram theme, the pagination its already styled with the theme
 -->

@if( isset($rows) )
    {{ $rows->links() }}
@endif
