const image_preview = (event) => {
    let img_path = event.target.files[0];
    const img_holder = document.querySelector('#image_container');
    const img_preview = document.querySelector('#image_preview');
    let extension = img_path.name.substring(img_path.name.lastIndexOf('.') + 1).toLowerCase();
    let img = document.createElement('img');

    if (extension == 'jpeg' || extension == 'jpg' || extension == 'png' || extension == 'gif' || extension == 'webp') {
        img_holder.removeChild(img_preview);     
        img.src = URL.createObjectURL(img_path);
        img.classList.add('card-img-top');
        img_holder.appendChild(img); 
    } else {
        img= document.createElement('div');
        img.classList.add('card-img-top__preview');
        img_holder.appendChild(img);
    }
}

const image_preview_avatar = (event) => {
    let img_path = event.target.files[0];
    const img_holder = document.querySelector('#image_preview');
    const img_preview = document.querySelector('#avatar');
    let extension = img_path.name.substring(img_path.name.lastIndexOf('.') + 1).toLowerCase();
    let img = document.createElement('img');

    if (extension == 'jpeg' || extension == 'jpg' || extension == 'png' || extension == 'gif' || extension == 'webp') {
        img_holder.removeChild(img_preview);     
        img.src = URL.createObjectURL(img_path);
        img.classList.add('avatar');
        img_holder.appendChild(img); 
    } else {
        img= document.createElement('div');
        img.classList.add('card-img-top__preview');
        img_holder.appendChild(img);
    }
}