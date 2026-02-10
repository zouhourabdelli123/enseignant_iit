        // Mise à jour de la date et heure
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('fr-FR', options);
            const timeString = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

            document.getElementById('current-date').textContent =
                dateString.charAt(0).toUpperCase() + dateString.slice(1);
            document.getElementById('current-time').textContent = timeString;

            // Mise à jour de la dernière activité
            document.getElementById('lastActivity').textContent = timeString;
        }

        // Animation des cases à cocher améliorée
        document.querySelectorAll('.task-checkbox input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                const taskTitle = taskItem.querySelector('.task-details h4');
                const taskPriority = taskItem.querySelector('.task-priority');

                if (this.checked) {
                    // Animation de validation
                    taskItem.style.transition = 'all 0.5s ease';
                    taskItem.style.opacity = '0.7';
                    taskItem.style.transform = 'translateX(10px)';

                    taskTitle.style.textDecoration = 'line-through';
                    taskTitle.style.color = 'var(--text-gray)';

                    if (taskPriority) {
                        taskPriority.innerHTML = '<i class="fas fa-check"></i> Terminé';
                        taskPriority.className = 'task-priority priority-low';
                    }

                    // Mise à jour du compteur
                    const pendingCount = document.getElementById('pendingAssignments');
                    if (pendingCount) {
                        let count = parseInt(pendingCount.textContent);
                        if (count > 0) {
                            pendingCount.textContent = count - 1;
                            pendingCount.style.color = 'var(--success)';
                            pendingCount.style.transform = 'scale(1.2)';
                            setTimeout(() => {
                                pendingCount.style.transform = 'scale(1)';
                            }, 300);
                        }
                    }

                    // Notification
                    showToast('Tâche marquée comme terminée!', 'success');
                } else {
                    taskItem.style.transition = 'all 0.3s ease';
                    taskItem.style.opacity = '1';
                    taskItem.style.transform = 'translateX(0)';

                    taskTitle.style.textDecoration = 'none';
                    taskTitle.style.color = '';

                    if (taskPriority && taskPriority.textContent.includes('Terminé')) {
                        taskPriority.innerHTML = 'Haute';
                        taskPriority.className = 'task-priority priority-high';

                        // Mise à jour du compteur
                        const pendingCount = document.getElementById('pendingAssignments');
                        if (pendingCount) {
                            let count = parseInt(pendingCount.textContent);
                            pendingCount.textContent = count + 1;
                        }
                    }
                }
            });
        });

        // Notification interactive améliorée
        const notificationBell = document.querySelector('.notification-bell');
        const notificationBadge = document.querySelector('.notification-badge');

       /*  notificationBell.addEventListener('click', function() {
            if (notificationBadge.textContent !== '0') {
                // Animation de suppression
                notificationBadge.style.transform = 'scale(0) rotate(45deg)';
                setTimeout(() => {
                    notificationBadge.textContent = '0';
                    notificationBadge.style.background = 'linear-gradient(135deg, var(--success), #28a745)';
                    notificationBadge.style.transform = 'scale(1) rotate(0)';
                }, 300);

                // Arrêter l'animation de pulsation
                notificationBell.classList.remove('pulse');

                // Notification
                showToast('Toutes les notifications ont été marquées comme lues', 'info');
            }
        }); */

        // Fonction pour afficher un toast amélioré
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                info: 'fa-info-circle',
                warning: 'fa-exclamation-triangle'
            };

            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: var(--white);
                color: var(--text-dark);
                padding: 16px 24px;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-lg);
                z-index: 10000;
                font-size: 0.95rem;
                border: 1px solid var(--light-gray);
                transform: translateX(100px);
                opacity: 0;
                transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 300px;
                max-width: 400px;
                border-left: 4px solid ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--accent-blue)'};
            `;

            toast.innerHTML = `
                <i class="fas ${icons[type] || icons.info}" style="color: ${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--accent-blue)'}; font-size: 1.2rem;"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
                toast.style.opacity = '1';
            }, 10);

            setTimeout(() => {
                toast.style.transform = 'translateX(100px)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 400);
            }, 4000);
        }

        // Gestionnaire de thème sombre
        /* const themeToggle = document.getElementById('themeToggle');
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'fas fa-sun';
                showToast('Mode sombre activé', 'info');
            } else {
                icon.className = 'fas fa-moon';
                showToast('Mode clair activé', 'info');
            }
        }); */

        // Animation au chargement améliorée
        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime();

            // Timer pour le prochain cours
            function updateNextCourseTimer() {
                const nextCourseTimer = document.getElementById('nextCourseTimer');
                if (nextCourseTimer) {
                    // Simuler un compte à rebours
                    const now = new Date();
                    const nextCourse = new Date(now);
                    nextCourse.setHours(10, 30, 0); // 10:30 prochain cours

                    if (now > nextCourse) {
                        nextCourse.setDate(nextCourse.getDate() + 1);
                    }

                    const diff = nextCourse - now;
                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                    nextCourseTimer.textContent = `${hours}h ${minutes}min`;
                }
            }

            updateNextCourseTimer();
            setInterval(updateNextCourseTimer, 60000);

            // Sidebar responsive améliorée avec bouton toggle
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 1024 && sidebar) {
                sidebar.classList.add('active');
                if (menuToggle) {
                    menuToggle.classList.add('active');
                }
            }
            
            // Fonction pour toggler la sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                if (menuToggle) {
                    menuToggle.classList.toggle('active');
                }
            }

            // Événement sur le bouton toggle
            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Sur mobile/tablet: click sur la sidebar (garde le comportement existant)
            if (window.innerWidth <= 1024) {
                sidebar.addEventListener('click', function(e) {
                    // Ne pas fermer si on clique sur un lien
                    if (e.target.closest('a') || e.target.tagName === 'A') return;
                    // Ne pas fermer si on clique sur le toggle button
                    if (e.target.closest('#menuToggle')) return;
                    
                    toggleSidebar();
                });
            }


            // Mettre à jour l'heure toutes les secondes
            setInterval(updateDateTime, 1000);

            // Effet de parallaxe amélioré
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const welcomeSection = document.querySelector('.welcome-section');
                const statCards = document.querySelectorAll('.stat-card');

                if (welcomeSection) {
                    welcomeSection.style.transform = `translateY(${scrolled * 0.02}px)`;
                }

                statCards.forEach((card, index) => {
                    card.style.transform = `translateY(${scrolled * 0.01 * (index + 1)}px)`;
                });
            });

            // Actions flottantes
           /*  document.getElementById('quickNote').addEventListener('click', function() {
                showToast('Créer une nouvelle note rapide', 'info');
            });
 */
          /*   document.getElementById('quickMail').addEventListener('click', function() {
                showToast('Ouvrir l\'éditeur de message', 'info');
            });

            document.getElementById('quickMeeting').addEventListener('click', function() {
                showToast('Planifier une nouvelle réunion', 'info');
            }); */

            // Animation du logo au chargement
            const logoIcon = document.querySelector('.logo-icon');
            setTimeout(() => {
                logoIcon.style.transform = 'rotate(360deg) scale(1.1)';
                setTimeout(() => {
                    logoIcon.style.transform = '';
                }, 600);
            }, 1000);
        });

        // Gestionnaire de clic pour le logo
       /*  document.getElementById('logoHeader').addEventListener('click', function() {
            showToast('Retour à l\'accueil', 'info');
        }); */


