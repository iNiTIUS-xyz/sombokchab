<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
    
    :root {
        --main-color-one: #0080ff;
        --main-color-one-rgb: 0, 128, 255;
        --border-color: #CFD0D0;
        --border-color-2: #ddd;
        --box-shadow: #4242421a;
        --box-shadow-2: #70707059;
        --body-color: #999;
        --paragraph-color: #666;
        --heading-color: #252525;
        --white-bg: #ffffff;
        --white-text: #ffffff;
        --heading-font: "Jost", sans-serif;
        --body-font: "Manrope", sans-serif;
        --jost-font: "Jost", sans-serif;
    }

    html {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        overflow-x: hidden;
    }

    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        outline: none;
        -moz-osx-font-smoothing: grayscale;
        /* Firefox */
        -webkit-font-smoothing: antialiased;
        /* WebKit  */
    }

    body {
        margin: 0;
        color: var(--body-color);
        overflow-x: hidden;
        font-family: var(--body-font);
        font-size: 14px;
        line-height: 26px;
    }

    @media only screen and (max-width: 480px) {
        body {
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 375px) {
        body {
            font-size: 14px;
        }
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: var(--heading-color);
        font-family: var(--body-font);
        margin: 0;
        -webkit-transition: 300ms;
        transition: 300ms;
    }

    p {
        color: var(--paragraph-color);
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
        hyphens: auto;
        margin-bottom: 0;
        line-height: 26px;
        font-size: 16px;
    }

    a {
        color: inherit;
        text-decoration: none;
        color: var(--body-color);
        -webkit-transition: 300ms;
        transition: 300ms;
    }

    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
        color: inherit;
    }

    .padding-10 {
        padding: 10px;
    }

    .padding-20 {
        padding: 20px;
    }

    .radius-20 {
        border-radius: 20px;
    }

    .radius-10 {
        border-radius: 10px;
    }

    .radius-5 {
        border-radius: 5px;
    }

    .label_title {
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        display: block;
        margin-bottom: 10px;
        color: var(--heading-color);
    }

    .label_title__postition {
        font-size: 14px;
        line-height: 20px;
        font-weight: 400;
        color: var(--heading-color);
        background: var(--white-bg);
        margin-bottom: -11px;
        position: relative;
        display: table;
        padding: 0 10px;
        z-index: 9990;
    }

    .form_control,
    .form__control,
    .form--control,
    .form-control {
        -moz-appearance: textfield;
        width: 100%;
        height: 48px;
        line-height: 48px;
        padding: 0 15px;
        border: 1px solid var(--border-color);
        background-color: unset;
        outline: none;
        color: var(--paragraph-color);
        -webkit-transition: 300ms;
        transition: 300ms;
        -webkit-box-shadow: 0 0 10px var(--box-shadow);
        box-shadow: 0 0 10px var(--box-shadow);
    }

    .form_control::-webkit-outer-spin-button,
    .form_control::-webkit-inner-spin-button,
    .form__control::-webkit-outer-spin-button,
    .form__control::-webkit-inner-spin-button,
    .form--control::-webkit-outer-spin-button,
    .form--control::-webkit-inner-spin-button,
    .form-control::-webkit-outer-spin-button,
    .form-control::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        -moz-appearance: textfield;
    }

    .form_control:focus,
    .form__control:focus,
    .form--control:focus,
    .form-control:focus {
        border-color: rgba(var(--main-color-one-rgb), 0.3);
        -webkit-box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
        box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
    }

    @media only screen and (max-width: 480px) {

        .form_control,
        .form__control,
        .form--control,
        .form-control {
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 375px) {

        .form_control,
        .form__control,
        .form--control,
        .form-control {
            font-size: 14px;
        }
    }

    .custom_form .single_flex_input:not(:first-child) {
        margin-top: 25px;
    }

    .custom_form .single_flex_input .single_input,
    .custom_form .single_flex_input .form-group {
        margin-top: 0 !important;
    }

    .custom_form .single_flex_input .single_input .js_nice_select,
    .custom_form .single_flex_input .form-group .js_nice_select {
        width: 100%;
    }

    .custom_form .single_input,
    .custom_form .form-group {
        width: 100%;
    }

    .custom_form .single_input:not(:first-child),
    .custom_form .form-group:not(:first-child) {
        margin-top: 25px;
    }

    .custom_form .single_input .label-title,
    .custom_form .form-group .label-title {
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        display: block;
        margin-bottom: 10px;
        color: var(--heading-color);
    }

    @media only screen and (max-width: 480px) {

        .custom_form .single_input .label-title,
        .custom_form .form-group .label-title {
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 375px) {

        .custom_form .single_input .label-title,
        .custom_form .form-group .label-title {
            font-size: 14px;
        }
    }

    .custom_form .single_input .input-icon,
    .custom_form .form-group .input-icon {
        position: absolute;
        bottom: 15px;
        left: 15px;
    }

    .custom_form .single_input .iti,
    .custom_form .form-group .iti {
        width: 100%;
    }

    .custom_form .single_input .form--control,
    .custom_form .single_input .form-control,
    .custom_form .form-group .form--control,
    .custom_form .form-group .form-control {
        -moz-appearance: textfield;
        width: 100%;
        height: 48px;
        line-height: 48px;
        padding: 0 15px;
        border: 1px solid var(--border-color);
        background-color: unset;
        outline: none;
        color: var(--paragraph-color);
        -webkit-transition: 300ms;
        transition: 300ms;
        -webkit-box-shadow: 0 0 10px var(--box-shadow);
        box-shadow: 0 0 10px var(--box-shadow);
    }

    .custom_form .single_input .form--control::-webkit-outer-spin-button,
    .custom_form .single_input .form--control::-webkit-inner-spin-button,
    .custom_form .single_input .form-control::-webkit-outer-spin-button,
    .custom_form .single_input .form-control::-webkit-inner-spin-button,
    .custom_form .form-group .form--control::-webkit-outer-spin-button,
    .custom_form .form-group .form--control::-webkit-inner-spin-button,
    .custom_form .form-group .form-control::-webkit-outer-spin-button,
    .custom_form .form-group .form-control::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        -moz-appearance: textfield;
    }

    .custom_form .single_input .form--control:focus,
    .custom_form .single_input .form-control:focus,
    .custom_form .form-group .form--control:focus,
    .custom_form .form-group .form-control:focus {
        border-color: rgba(var(--main-color-one-rgb), 0.3);
        -webkit-box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
        box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
    }

    @media only screen and (max-width: 480px) {

        .custom_form .single_input .form--control,
        .custom_form .single_input .form-control,
        .custom_form .form-group .form--control,
        .custom_form .form-group .form-control {
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 375px) {

        .custom_form .single_input .form--control,
        .custom_form .single_input .form-control,
        .custom_form .form-group .form--control,
        .custom_form .form-group .form-control {
            font-size: 14px;
        }
    }

    .custom_form .single_input .form--control.input-padding-left,
    .custom_form .single_input .form-control.input-padding-left,
    .custom_form .form-group .form--control.input-padding-left,
    .custom_form .form-group .form-control.input-padding-left {
        padding-left: 45px;
    }

    .custom_form .single_input .form--control#phone,
    .custom_form .single_input .form-control#phone,
    .custom_form .form-group .form--control#phone,
    .custom_form .form-group .form-control#phone {
        width: 100%;
        padding-left: 50px;
    }

    .custom_form .single_input .form-message,
    .custom_form .single_input textarea,
    .custom_form .form-group .form-message,
    .custom_form .form-group textarea {
        width: 100%;
        line-height: 24px;
        height: unset;
        padding: 5px 15px;
        border: 1px solid var(--border-color);
        background-color: unset;
        outline: none;
        color: var(--paragraph-color);
        -webkit-transition: 300ms;
        transition: 300ms;
        -webkit-box-shadow: 0 0 10px rgba(var(--white-rgb), 0.1);
        box-shadow: 0 0 10px rgba(var(--white-rgb), 0.1);
    }

    .custom_form .single_input .form-message:focus,
    .custom_form .single_input textarea:focus,
    .custom_form .form-group .form-message:focus,
    .custom_form .form-group textarea:focus {
        border-color: rgba(var(--main-color-one-rgb), 0.3);
        -webkit-box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
        box-shadow: 0 0 10px rgba(var(--main-color-one-rgb), 0.1);
    }

    .custom_form .single_input .form-message.textarea-height,
    .custom_form .single_input textarea.textarea-height,
    .custom_form .form-group .form-message.textarea-height,
    .custom_form .form-group textarea.textarea-height {
        height: 100px;
    }

    .custom_form .single_input-icon,
    .custom_form .form-group-icon {
        position: relative;
    }

    .custom_form .single_input-icon::after,
    .custom_form .form-group-icon::after {
        content: "";
        position: absolute;
        height: 55px;
        width: 2px;
        background-color: #f3f3f3;
        bottom: 0;
        left: 40px;
    }

    .custom_form .single_input-icon .form--control,
    .custom_form .single_input-icon .form-control,
    .custom_form .form-group-icon .form--control,
    .custom_form .form-group-icon .form-control {
        padding-left: 50px;
        position: relative;
    }

    .custom_form .single_input-select,
    .custom_form .form-group-select {
        width: 100%;
        border: 1px solid var(--border-color);
    }

    .custom_form textarea {
        height: unset !important;
    }

    .custom_form .submit-btn {
        margin-top: 25px;
    }

    .submit_btn {
        border: 2px solid var(--main-color-one);
        background-color: var(--main-color-one);
        color: var(--white-text);
        padding: 8px 15px;
        -webkit-transition: 300ms;
        transition: 300ms;
    }

    .submit_btn:hover {
        background-color: rgba(var(--main-color-one-rgb), 0.9);
    }

    /* Chat with us */
    .chatContact__btn {
        font-size: 16px;
        font-weight: 400;
        font-family: var(--body-font);
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        /* text-transform: capitalize; */
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        text-align: center;
        gap: 5px;
        cursor: pointer;
        line-height: 20px;
        padding: 10px 25px;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        -webkit-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
        background-color: var(--main-color-one);
        color: var(--white-text);
        position: relative;
        z-index: 0;
        overflow: hidden;
        border: 1px solid transparent;
        /*border-radius: 30px;*/
    }

    @media only screen and (max-width: 575.98px) {
        .chatContact__btn {
            padding: 10px 20px;
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 375px) {
        .chatContact__btn {
            padding: 10px 15px;
            font-size: 14px;
        }
    }

    .chatContact__btn i,
    .chatContact__btn .material-symbols-outlined {
        font-size: 20px;
        line-height: 1;
    }

    .chatContact__contents {
        background-color: var(--white-bg);
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px var(--box-shadow-2);
        box-shadow: 0 0 10px var(--box-shadow-2);
        height: 540px;
        max-height: calc(100vh - 50px);
        overflow-y: auto;
        visibility: hidden;
        opacity: 0;
        -webkit-transition: 0.2s ease-in;
        transition: 0.2s ease-in;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: -1;
        max-width: 400px;
    }

    @media only screen and (max-width: 480px) {
        .chatContact__contents {
            height: 100%;
            max-height: 100%;
            bottom: 0;
            right: 0;
            max-width: 100%;
        }
    }

    .chatContact__contents.showChat {
        visibility: visible;
        opacity: 1;
        z-index: 9992;
    }

    .chatContact__contents__header {
        background-color: var(--main-color-one);
        padding: 10px 10px;
        position: relative;
    }

    .chatContact__contents__header__close {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: 5px;
        position: absolute;
        right: 20px;
        top: 20px;
    }

    .chatContact__contents__header__close__icon {
        font-size: 24px;
        line-height: 24px;
        color: var(--white-text);
        cursor: pointer;
    }

    .chatContact__contents__header__close__icon i,
    .chatContact__contents__header__close__icon .material-symbols-outlined {
        font-size: 24px;
        line-height: 24px;
    }

    .chatContact__contents__header__main {
        max-width: 400px;
    }

    .chatContact__contents__header__say {
        font-size: 50px;
        max-width: 50px;
    }

    .chatContact__contents__header__title {
        font-size: 20px;
        font-weight: 600;
        line-height: 24px;
        color: var(--white-text);
    }

    .chatContact__contents__header__para {
        font-size: 14px;
        font-weight: 300;
        line-height: 20px;
        color: var(--white-text);
        opacity: 0.8;
    }

    .chatContact__contents__header__team {
        padding-right: 50px;
    }

    .chatContact__contents__header__team__flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: 10px;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .chatContact__contents__header__team__author {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .chatContact__contents__header__team__author__item {
        max-width: 45px;
        border: 2px solid var(--white);
        border-radius: 50%;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        height: 40px;
        width: 40px;
    }

    .chatContact__contents__header__team__author__item:hover {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    .chatContact__contents__header__team__author__item:not(:first-child) {
        margin-left: -10px;
    }

    .chatContact__contents__header__team__author__item img {
        border-radius: 50%;
        height: 100%;
        width: 100%;
    }

    .chatContact__contents__header__team__name {
        font-size: 18px;
        font-weight: 600;
        line-height: 28px;
        color: var(--white-text);
    }

    .chatContact__contents__header__team__activity {
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: var(--white-text);
        opacity: 0.8;
    }

    .chatContact__contents__inner {
        background-color: var(--white-bg);
        padding: 20px 20px;
        max-height: 100%;
        min-height: 150px;
        overflow-y: auto;
        scrollbar-color: var(--white-bg) var(--white-bg);
        scrollbar-width: thin;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    @media only screen and (max-width: 480px) {
        .chatContact__contents__inner {
            height: 100vh;
            max-height: 100%;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }
    }

    .chatContact__contents__inner::-webkit-scrollbar {
        background-color: var(--white-bg);
    }

    .chatContact__contents__inner::-webkit-scrollbar-thumb {
        background-color: var(--white-bg);
    }

    .chatContact__contents__inner__faq {
        width: 100%;
    }

    .chatContact__contents__inner__faq__flex {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        width: 100%;
    }

    .chatContact__contents__inner__faq__item {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding: 7px 15px;
        font-size: 15px;
        line-height: 24px;
        color: var(--main-color-one);
        border: 1px solid var(--main-color-one);
        background-color: rgba(var(--main-color-one-rgb), 0.1);
        border-radius: 30px;
        cursor: pointer;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .chatContact__contents__inner__faq__item:not(:first-child) {
        margin-top: 10px;
    }

    .chatContact__contents__inner__faq__item:hover {
        background-color: var(--main-color-one);
        color: var(--white-text);
    }

    .chatContact__contents__inner__chat__item {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: end;
        width: 100%;
        gap: 10px;
    }

    .chatReply__img {
        width: 40px;
        height: 40px;
    }

    .chatReply__img img {
        border-radius: 50%;
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .chatContact__contents__inner__chat__item.chatReply {
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }

    .chatContact__contents__inner__chat__item.chatReply .chatContact__contents__inner__chat__item__para {
        background-color: var(--border-color);
        color: var(--heading-color);
        border-radius: 0 10px 10px 10px;
    }

    .chatContact__contents__inner__chat__item:not(:first-child) {
        margin-top: 10px;
    }

    .chatContact__contents__inner__chat__item__para {
        font-size: 14px;
        line-height: 20px;
        font-weight: 400;
        background-color: var(--main-color-one);
        padding: 7px 15px;
        border-radius: 10px 0 10px 10px;
        color: var(--white-text);
    }

    .chatContact__contents__inner__form {
        padding: 20px;
    }

    @media only screen and (max-width: 480px) {
        .chatContact__contents__inner__form {
            height: 100vh;
            max-height: 100%;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }
    }

    .chatContact__contents__footer {
        padding: 10px 20px 20px;
        border-top: 1px solid var(--border-color);
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .chatContact__contents__footer__bottom {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .chatContact__contents__footer__bottom__left {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        gap: 10px;
    }

    .chatContact__contents__footer__bottom__right {
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .chatContact__contents__footer__input textarea {
        width: 100%;
        height: 40px;
        line-height: 20px;
        padding: 7px 10px;
        border: 0;
        background-color: unset;
        outline: none;
        color: var(--paragraph-color);
        -webkit-transition: 300ms;
        transition: 300ms;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        resize: none;
    }

    .chatContact__contents__footer__input textarea:focus {
        background-color: var(--white-bg);
    }

    .chatContact__contents__footer__icon {
        font-size: 22px;
        line-height: 22px;
        color: var(--paragraph-color);
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .chatContact__contents__footer__icon i,
    .chatContact__contents__footer__icon .material-symbols-outlined {
        font-size: 22px;
        line-height: 22px;
    }

    .chatContact__contents__footer__icon:hover {
        color: var(--main-color-one);
    }

    .chatContact__contents__footer__icon.attachment {
        position: relative;
        cursor: pointer;
    }

    .chatContact__contents__footer__icon.attachment .inputTag {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        cursor: pointer;
        opacity: 0;
        color: var(--paragraph-color);
    }

    /*.chatContact__contents__footer__icon.attachment::before {*/
    /*    content: "\e2bc";*/
    /*    font-family: "Material Symbols Outlined";*/
    /*    font-size: 20px;*/
    /*    font-weight: 700;*/
    /*    height: 100%;*/
    /*    width: 100%;*/
    /*    color: var(--paragraph-color);*/
    /*}*/
    .chatContact__contents__footer .chatSumbit {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 40px;
        width: 40px;
        background-color: var(--search-bg);
        color: var(--paragraph-color);
        font-size: 24px;
        line-height: 24px;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        border-radius: 50%;
    }

    .chatContact__contents__footer .chatSumbit i,
    .chatContact__contents__footer .chatSumbit .material-symbols-outlined {
        font-size: 24px;
        line-height: 24px;
    }

    .chatContact__contents__footer .chatSumbit:hover {
        background-color: var(--main-color-one);
        color: var(--white);
    }

    /*preloader css*/
    .chatContact__contents__inner {
        position: relative;
    }

    .preloader__chat {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        z-index: 9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preloader__wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
        overflow: hidden;
    }

    .circle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin: 7px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .circle:before {
        content: "";
        width: 20px;
        height: 20px;
        border-radius: 50%;
        opacity: 0.7;
        animation: scale 2s infinite cubic-bezier(0, 0, 0.49, 1.02);
    }

    .circle-1 {
        background-color: var(--main-color-one);
    }

    .circle-1:before {
        background-color: var(--main-color-one);
        animation-delay: 200ms;
    }

    .circle-2 {
        background-color: var(--main-color-one);
    }

    .circle-2:before {
        background-color: var(--main-color-one);
        animation-delay: 400ms;
    }

    .circle-3 {
        background-color: var(--main-color-one);
    }

    .circle-3:before {
        background-color: var(--main-color-one);
        animation-delay: 600ms;
    }

    .circle-4 {
        background-color: var(--main-color-one);
    }

    .circle-4:before {
        background-color: var(--main-color-one);
        animation-delay: 800ms;
    }

    .circle-5 {
        background-color: var(--main-color-one);
    }

    .circle-5:before {
        background-color: var(--main-color-one);
        animation-delay: 1000ms;
    }

    @keyframes scale {
        0% {
            transform: scale(1);
        }

        50%,
        75% {
            transform: scale(2.5);
        }

        78%,
        100% {
            opacity: 0;
        }
    }


    .text-right-time {
        text-align: right;
        display: inherit;
        margin: 0;
    }

    .chatContact__contents__footer__input {
        border: 1px solid #f1f1f1;
        line-height: 1;
    }


    .typing-loader {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        -webkit-animation: line 1.5s linear infinite alternate;
        -moz-animation: line 1.5s linear infinite alternate;
        animation: line 1.5s linear infinite alternate;
    }

    @-webkit-keyframes line {
        0% {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 0.2),
                24px 0px 0px 0px rgba(255, 255, 255, 0.2);
        }

        25% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 2),
                24px 0px 0px 0px rgba(255, 255, 255, 0.2);
        }

        75% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 0.2),
                24px 0px 0px 0px rgba(255, 255, 255, 2);
        }
    }

    @-moz-keyframes line {
        0% {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 0.2),
                24px 0px 0px 0px rgba(255, 255, 255, 0.2);
        }

        25% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 2),
                24px 0px 0px 0px rgba(255, 255, 255, 0.2);
        }

        75% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 0.2),
                24px 0px 0px 0px rgba(255, 255, 255, 2);
        }
    }

    @keyframes line {
        0% {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 12px 0px 0px 0px rgba(0, 0, 0, 0.2),
                24px 0px 0px 0px rgba(0, 0, 0, 0.2);
        }

        25% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 2),
                24px 0px 0px 0px rgba(255, 255, 255, 0.2);
        }

        75% {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 12px 0px 0px 0px rgba(255, 255, 255, 0.2),
                24px 0px 0px 0px rgba(255, 255, 255, 2);
        }
    }
</style>
