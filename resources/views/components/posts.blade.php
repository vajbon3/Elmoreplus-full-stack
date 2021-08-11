<!-- post template for dynamically creating posts with Javascript -->
<x-post classoptions="invisible absolute template-post" />

<!-- template for rendering a comment with Javascript -->
<x-comment classoptions="invisible absolute template-comment" />

<!-- template for throttle -->
<x-throttle classoptions="invisible absolute template-throttle" />

@foreach($posts as $post)
    <x-post :post="$post" />
@endforeach
<script src="{{ mix("js/posts.js") }}"></script>
