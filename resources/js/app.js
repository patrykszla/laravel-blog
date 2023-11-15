import './bootstrap';
import Search from './live-search';
import Chat from "./chat";

if(document.querySelector(".header-search-icon")) {
    new Search();
}
// alert('test 123444');

if(document.querySelector(".header-chat-icon")) {
    new Chat();
}