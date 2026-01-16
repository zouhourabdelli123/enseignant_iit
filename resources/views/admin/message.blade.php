@extends('dashbaord.main')

@section('content')
    <link href="{{ asset('css/common_datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/message.css') }}" rel="stylesheet">

    <div class="page-container" >
        <div class="chat-container">
            <!-- Sidebar - Liste des conversations -->
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <h3>Messages</h3>
                    <input type="text" class="chat-search" placeholder="Rechercher une conversation...">
                </div>

                <div class="chat-list">
                    <div class="chat-item active" onclick="selectChat('admin')">
                        <div class="chat-item-avatar">A</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">
                                <span>Administration</span>
                                <span class="chat-item-time">10:30</span>
                            </div>
                            <div class="chat-item-last">Mise à jour des horaires</div>
                        </div>
                        <div class="chat-item-unread">2</div>
                    </div>

                    <div class="chat-item" onclick="selectChat('dept')">
                        <div class="chat-item-avatar"
>D</div>
                        <div class="chat-item-info">
                            <div class="chat-item-name">
                                <span>Département IT</span>
                                <span class="chat-item-time">13 Jan</span>
                            </div>
                            <div class="chat-item-last">Réunion pédagogique</div>
                        </div>
                        <div class="chat-item-unread">1</div>
                    </div>
                </div>
            </div>

            <!-- Zone principale de conversation -->
            <div class="chat-main">
                <div class="chat-header">
                    <div class="chat-header-avatar">A</div>
                    <div class="chat-header-info">
                        <h4>Administration</h4>
                        <div class="chat-header-status">
                            <span class="status-dot-online"></span>
                            <span>En ligne</span>
                        </div>
                    </div>
                </div>

                <div class="chat-messages" id="chatMessages">
                    <div class="message">
                        <div class="message-avatar">A</div>
                        <div class="message-content">
                            <div class="message-bubble">
                                Bonjour, nous vous informons d'une mise à jour des horaires pour la semaine prochaine.
                            </div>
                            <div class="message-time">10:25</div>
                        </div>
                    </div>

                    <div class="message sent">
                        <div class="message-avatar">P</div>
                        <div class="message-content">
                            <div class="message-bubble">
                                Merci pour l'information. Pouvez-vous me donner plus de détails ?
                            </div>
                            <div class="message-time">10:27</div>
                        </div>
                    </div>

                    <div class="message">
                        <div class="message-avatar">A</div>
                        <div class="message-content">
                            <div class="message-bubble">
                                Bien sûr ! Les cours de lundi seront décalés d'une heure. Vous commencerez à 9h au lieu de
                                8h.
                            </div>
                            <div class="message-time">10:30</div>
                        </div>
                    </div>
                </div>

                <div class="chat-input-area">
                    <div class="chat-input-wrapper">
                        <input type="text" class="chat-input" id="messageInput" placeholder="Tapez votre message...">
                        <button class="chat-send-btn" onclick="sendMessage()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/messages.js') }}"></script>

@endsection