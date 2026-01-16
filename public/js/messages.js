// ====================================
// INTERFACE DE CHAT INSTANTANÉ
// ====================================

// Sélectionner une conversation
function selectChat(chatId) {
    // Retirer active de tous les items
    document.querySelectorAll('.chat-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Ajouter active à l'item cliqué
    event.currentTarget.classList.add('active');
    
    // TODO: Charger les messages de cette conversation
    console.log('Conversation sélectionnée:', chatId);
}

// Envoyer un message
function sendMessage() {
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    const messagesContainer = document.getElementById('chatMessages');
    const now = new Date();
    const time = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();
    
    // Créer le nouveau message
    const messageHTML = `
        <div class="message sent">
            <div class="message-avatar">P</div>
            <div class="message-content">
                <div class="message-bubble">${escapeHtml(message)}</div>
                <div class="message-time">${time}</div>
            </div>
        </div>
    `;
    
    messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
    
    // Vider l'input
    input.value = '';
    
    // Scroller vers le bas
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    // TODO: Envoyer le message au serveur
    // $.ajax({
    //     url: '/messages/send',
    //     method: 'POST',
    //     data: { message: message },
    //     success: function(response) {
    //         console.log('Message envoyé');
    //     }
    // });
}

// Échapper le HTML pour éviter les injections XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    
    // Auto-scroll au chargement
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    // Envoi avec Enter
    if (messageInput) {
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});
