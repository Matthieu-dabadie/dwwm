document.getElementById("inputImage").addEventListener("change", function (e) {
  const file = e.target.files[0];
  if (!file) {
    return;
  }

  const reader = new FileReader();
  reader.onload = function (event) {
    const img = new Image();
    img.onload = function () {
      const canvas = document.getElementById("imageCanvas");
      const ctx = canvas.getContext("2d");
      let scale = 1;
      let position = { x: 0, y: 0 };
      let dragStart, dragged;

      function redraw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(
          img,
          position.x,
          position.y,
          img.width * scale,
          img.height * scale
        );
      }

      // Gestion du déplacement de l'image
      canvas.addEventListener("mousedown", function (e) {
        dragStart = { x: e.offsetX - position.x, y: e.offsetY - position.y };
        dragged = false;
      });

      canvas.addEventListener("mousemove", function (e) {
        if (dragStart) {
          position.x = e.offsetX - dragStart.x;
          position.y = e.offsetY - dragStart.y;
          redraw();
          dragged = true;
        }
      });

      canvas.addEventListener("mouseup", function (e) {
        dragStart = null;
        if (!dragged) return;
      });

      // Gestion du zoom
      canvas.addEventListener("wheel", function (e) {
        e.preventDefault();
        let zoomIntensity = 0.1;
        let wheel = e.deltaY < 0 ? 1 : -1;
        let zoom = Math.exp(wheel * zoomIntensity);

        scale *= zoom;
        redraw();
      });

      redraw();
    };
    img.src = event.target.result;
  };
  reader.readAsDataURL(file);
});

document.getElementById("saveButton").addEventListener("click", function () {
  const canvas = document.getElementById("imageCanvas");
  canvas.toBlob(function (blob) {
    const formData = new FormData();
    formData.append("croppedImage", blob, "croppedImage.png");

    fetch("index.php?controller=banner&action=saveBannerImage", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          window.location.href = "index.php?controller=home&action=index";
        } else {
          console.error(
            "Erreur lors de l'enregistrement de l'image: " + data.message
          );
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Erreur lors de l'enregistrement de l'image.");
      });
  }, "image/png");
});
