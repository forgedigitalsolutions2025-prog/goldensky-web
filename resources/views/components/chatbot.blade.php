<!-- AI Chatbot Widget -->
<div x-data="chatbot()" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50">
    <div class="flex flex-col items-end space-y-4">
        <!-- WhatsApp Button -->
        <a 
            href="https://wa.me/94714831035"
            target="_blank"
            rel="noopener noreferrer"
            class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-500 text-white rounded-full p-4 shadow-2xl transform transition-all duration-300 hover:scale-110 focus:outline-none"
            title="Chat on WhatsApp"
        >
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>

        <!-- Chat Button -->
        <button 
            @click="toggleChat()"
            class="bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white rounded-full p-4 shadow-2xl transform transition-all duration-300 hover:scale-110 focus:outline-none relative"
            :class="{ 'animate-bounce': !isOpen && hasNewMessage }"
        >
            <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span x-show="!isOpen && unreadCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" x-text="unreadCount"></span>
        </button>
    </div>

    <!-- Chat Window -->
    <div 
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 transform scale-95 translate-y-4"
        class="absolute bottom-20 right-0 w-[calc(100vw-2rem)] max-w-96 h-[85vh] max-h-[500px] bg-white rounded-2xl shadow-2xl border-2 border-gold/30 flex flex-col overflow-hidden"
        style="display: none;"
    >
        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-gold-dark to-gold text-white p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Golden Sky Assistant</h3>
                    <p class="text-xs text-white/80" x-text="isTyping ? 'Typing...' : 'Online'"></p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button @click="clearHistory()" class="text-white hover:text-white/80 transition" title="Clear History">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            <button @click="toggleChat()" class="text-white hover:text-white/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            </div>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50" id="chat-messages">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-gold rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">GS</span>
                </div>
                <div class="flex-1">
                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                        <p class="text-sm text-gray-800">
                            Hello! 👋 Welcome to Golden Sky Hotel & Wellness. I'm your AI assistant. How can I help you today? You can ask me about:
                        </p>
                        <ul class="mt-2 text-xs text-gray-600 space-y-1 list-disc list-inside">
                            <li>Room availability and types</li>
                            <li>Hotel amenities</li>
                            <li>Restaurant information</li>
                            <li>Booking procedures</li>
                            <li>Check-in/check-out times</li>
                        </ul>
                    </div>
                    <p class="text-xs text-gray-500 mt-1" x-text="getCurrentTime()"></p>
                </div>
            </div>

            <!-- Dynamic Messages -->
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.type === 'user' ? 'flex items-start space-x-2 justify-end' : 'flex items-start space-x-2'">
                    <template x-if="message.type === 'bot'">
                        <div class="w-8 h-8 bg-gold rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-xs font-bold">GS</span>
                        </div>
                    </template>
                    <div class="flex-1" :class="message.type === 'user' ? 'max-w-[80%]' : ''">
                        <div 
                            :class="message.type === 'user' 
                                ? 'bg-gradient-to-r from-gold to-gold-dark text-white rounded-lg p-3 shadow-sm ml-auto' 
                                : message.isError 
                                    ? 'bg-red-50 border border-red-200 rounded-lg p-3 shadow-sm'
                                : 'bg-white rounded-lg p-3 shadow-sm border border-gray-200'"
                        >
                            <p class="text-sm whitespace-pre-wrap" :class="message.type === 'user' ? 'text-white' : message.isError ? 'text-red-800' : 'text-gray-800'" x-html="formatMessage(message.text)"></p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1" :class="message.type === 'user' ? 'text-right' : ''" x-text="message.time"></p>
                    </div>
                    <template x-if="message.type === 'user'">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-600 text-xs font-bold">U</span>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-gold rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">GS</span>
                </div>
                <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-gray-200">
            <form @submit.prevent="sendMessage()" class="flex space-x-2">
                <input 
                    type="text" 
                    x-model="inputMessage"
                    @keydown.enter.prevent="sendMessage()"
                    placeholder="Type your message..."
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent"
                    :disabled="isTyping"
                >
                <button 
                    type="submit"
                    :disabled="!inputMessage.trim() || isTyping"
                    class="bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white px-4 py-2 rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function chatbot() {
    return {
        isOpen: false,
        messages: [],
        inputMessage: '',
        isTyping: false,
        unreadCount: 0,
        hasNewMessage: false,
        sessionId: null,
        conversationHistory: [],
        errorMessage: null,
        retryCount: 0,
        maxRetries: 3,

        init() {
            // Initialize session ID from localStorage or generate new one
            this.sessionId = localStorage.getItem('chat_session_id') || this.generateSessionId();
            localStorage.setItem('chat_session_id', this.sessionId);
            
            // Load conversation history from localStorage
            this.loadConversationHistory();
        },

        generateSessionId() {
            return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        },

        loadConversationHistory() {
            try {
                const saved = localStorage.getItem('chat_history_' + this.sessionId);
                if (saved) {
                    const parsed = JSON.parse(saved);
                    this.conversationHistory = parsed.history || [];
                    // Optionally restore messages for display (last 10)
                    if (parsed.messages && parsed.messages.length > 0) {
                        this.messages = parsed.messages.slice(-10);
                    }
                }
            } catch (e) {
                console.error('Failed to load conversation history:', e);
            }
        },

        saveConversationHistory() {
            try {
                const data = {
                    history: this.conversationHistory,
                    messages: this.messages,
                    timestamp: new Date().toISOString()
                };
                localStorage.setItem('chat_history_' + this.sessionId, JSON.stringify(data));
            } catch (e) {
                console.error('Failed to save conversation history:', e);
            }
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.unreadCount = 0;
                this.hasNewMessage = false;
                this.errorMessage = null;
                // Scroll to bottom when opening
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
            }
        },

        async sendMessage() {
            if (!this.inputMessage.trim() || this.isTyping) return;

            const userMessage = this.inputMessage.trim();
            this.inputMessage = '';
            this.errorMessage = null;
            
            // Add user message
            const userMsg = {
                type: 'user',
                text: userMessage,
                time: this.getCurrentTime()
            };
            this.messages.push(userMsg);

            // Add to conversation history for context
            this.conversationHistory.push({
                role: 'user',
                content: userMessage
            });

            // Keep history manageable (last 20 messages)
            if (this.conversationHistory.length > 20) {
                this.conversationHistory = this.conversationHistory.slice(-20);
            }

            this.isTyping = true;
            this.scrollToBottom();
            this.saveConversationHistory();

            try {
                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        message: userMessage,
                        session_id: this.sessionId,
                        conversation_history: this.conversationHistory.slice(-10) // Send last 10 for context
                    })
                });

                let data;
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    if (response.status === 429) {
                        // Rate limit exceeded
                        throw new Error('rate_limit');
                    }
                    throw new Error(errorData.error || 'server_error');
                }

                data = await response.json();
                
                // Update session ID if provided
                if (data.session_id) {
                    this.sessionId = data.session_id;
                    localStorage.setItem('chat_session_id', this.sessionId);
                }
                
                // Simulate natural typing delay (300-800ms)
                const typingDelay = 300 + Math.random() * 500;
                await new Promise(resolve => setTimeout(resolve, typingDelay));
                
                // Add bot response
                const botMsg = {
                    type: 'bot',
                    text: data.response,
                    time: this.getCurrentTime()
                };
                this.messages.push(botMsg);

                // Add to conversation history
                this.conversationHistory.push({
                    role: 'assistant',
                    content: data.response
                });

                this.retryCount = 0; // Reset retry count on success
                this.saveConversationHistory();

                if (!this.isOpen) {
                    this.unreadCount++;
                    this.hasNewMessage = true;
                }
            } catch (error) {
                console.error('Chat error:', error);
                this.retryCount++;
                
                let errorText = 'Sorry, I encountered an error. Please try again.';
                
                if (error.message === 'rate_limit') {
                    errorText = "I'm receiving too many messages. Please wait a moment before sending another message.";
                } else if (this.retryCount < this.maxRetries) {
                    errorText = 'Connection issue. Retrying...';
                    // Auto-retry after 2 seconds
                    setTimeout(() => {
                        this.sendMessage();
                    }, 2000);
                } else {
                    errorText = 'Sorry, I\'m having trouble connecting. Please try again later or contact us directly via WhatsApp.';
                    this.retryCount = 0; // Reset after max retries
                }
                
                this.messages.push({
                    type: 'bot',
                    text: errorText,
                    time: this.getCurrentTime(),
                    isError: true
                });
                
                this.errorMessage = errorText;
            } finally {
                this.isTyping = false;
                this.scrollToBottom();
            }
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const messagesContainer = document.getElementById('chat-messages');
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });
        },

        getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        },

        formatMessage(text) {
            if (!text) return '';
            // Convert newlines to <br>
            return text.replace(/\n/g, '<br>');
        },

        clearHistory() {
            if (confirm('Clear conversation history?')) {
                this.messages = [];
                this.conversationHistory = [];
                localStorage.removeItem('chat_history_' + this.sessionId);
                this.sessionId = this.generateSessionId();
                localStorage.setItem('chat_session_id', this.sessionId);
                this.scrollToBottom();
            }
        }
    }
}
</script>
