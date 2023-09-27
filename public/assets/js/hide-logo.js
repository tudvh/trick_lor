const hideLogo = () => {
  const hideLogoInterval = setInterval(() => {
    const logoDiv = document.querySelector('div:has(img[alt="www.000webhost.com"])')

    console.log(logoDiv)

    if (logoDiv) {
      logoDiv.remove()
      clearInterval(hideLogoInterval)
    }
  }, 10)
}

hideLogo()
