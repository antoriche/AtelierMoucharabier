import React from "react";
import ReactDOM from 'react-dom'
import {ModelsForm} from './Components/ModelsForm'
import $ from 'jquery';

document.addEventListener("DOMContentLoaded", () => {
    Array.prototype.forEach.call(document.getElementsByClassName('ModelsForm'), (domelt)=>{
        ReactDOM.render(<ModelsForm value={domelt.getAttribute('value')} />, domelt);
    });
});

