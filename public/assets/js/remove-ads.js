let hasAds = false;
const removeAdsId = setInterval(() => {
    const div = document.querySelector(
        'div:has(img[alt="www.000webhost.com"])'
    );
    console.log(div);

    if (div) {
        div.remove();
        hasAds = true;
    }
    if (hasAds) {
        clearInterval(removeAdsId);
    }
}, 10);
