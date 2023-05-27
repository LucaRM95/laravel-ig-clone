const likeDetector = (image_id, value) => {
    const url = `http://proyecto-laravel.com.devel/`;
    const src_img_red = "http://proyecto-laravel.com.devel/img/heart-red.png";
    const src_img_grey = "http://proyecto-laravel.com.devel/img/heart-grey.png";

    //const count_likes_span = document.querySelector("#count_likes");
    const like_anchor_register = document.querySelector(`#${value}`);

    if (like_anchor_register.src == src_img_red) {
        like_anchor_register.src = src_img_grey;
        fetch(`${url}dislike/${image_id}`).then((response) => {
            console.log(response);
        });
    } else {
        like_anchor_register.src = src_img_red;
        fetch(`${url}like/${image_id}`).then((response) => {
            console.log(response);
        });
    }
    //count_likes_span.innerHTML = count;
};
