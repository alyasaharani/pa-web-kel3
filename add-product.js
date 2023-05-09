const toolbarOptions = [
  ['bold', 'italic', "underline", 'strike'],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  [{ list: "ordered" }, { list: "bullet" }],
  [{ script: "sub" }, { script: "super" }],
  [{ indent: "+1" }, { indent: "-1" }],
  [{ align: [] }],
  [{ size: ["small", "large", "huge", false] }],
  ["image", "link", "video", "formula"],
  [{ color: [] }, { background: [] }],
  [{ font: [] }],
  ['code-block', "blockquote"],
];

const quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions,
  },
  theme: "snow"
})

$('#image').on('change', (e) => {
  console.log("Makan")
  const file = document.querySelector('#image').files[0];
  const reader = new FileReader();

  reader.addEventListener('load', (ee) => {
    $('.img').attr('src', ee.target.result);
    $('.img').attr('height', '128px');
  });

  reader.readAsDataURL(file);
});

