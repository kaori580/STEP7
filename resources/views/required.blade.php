@php
    <!-- バリデーションルールが配列の形では無い場合、配列にする -->
    if(isset($rules) && is_array($rules) === false) {
        $rules = explode('|', $rules);
    }

    <!-- 必須表示フラグを初期化 -->
    $is_required = false;

    <!-- バリデーションルール配列の中にrequiredがあれば必須マークを使用する -->
    if(isset($rules) && is_array($rules) && in_array('required', $rules, true)) {
        $is_required = true;
    }
@endphp

@if ($is_required)
    <span class="badge badge-danger">必須</span>
@endif
