import './bootstrap';
import { mountQuill } from './quill';
import Alpine from 'alpinejs';
window.mountQuill = mountQuill; //add for editor
window.Alpine = Alpine;

Alpine.start();
