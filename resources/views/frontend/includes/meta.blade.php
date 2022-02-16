@php
if(!isset($meta_page_type)){
$meta_page_type = 'website';
}
@endphp

@switch($meta_page_type)
@case('website')
<meta property="og:type" content="website" />
@break

@case('profile')
<meta property="profile:first_name" content="{{$$module_name_singular->first_name}}" />
<meta property="profile:last_name" content="{{$$module_name_singular->last_name}}" />
<meta property="profile:username" content="{{$$module_name_singular->email}}" />
<meta property="profile:gender" content="{{$$module_name_singular->gender}}" />
@break

@default

@endswitch