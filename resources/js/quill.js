import Quill from 'quill';
import 'quill/dist/quill.snow.css';

export function mountQuill({ holderId = 'editor', inputId = 'content' , initialHTML = '' }) {
  const toolbarOptions = [
    [{ header: [1, 2, 3, false] }],
    ['bold', 'italic', 'underline'],
    [{ list: 'ordered' }, { list: 'bullet' }],
    ['link', 'blockquote', 'code-block'],
    ['clean'],
  ];
  const quill = new Quill(`#${holderId}`, { theme: 'snow', modules: { toolbar: toolbarOptions }});
  if (initialHTML) quill.root.innerHTML = initialHTML;

  const form = document.querySelector(`textarea#${inputId}`)?.closest('form');
  form?.addEventListener('submit', () => {
    const hidden = document.getElementById(inputId);
    hidden.value = quill.root.innerHTML;
  });

  return quill;
}
