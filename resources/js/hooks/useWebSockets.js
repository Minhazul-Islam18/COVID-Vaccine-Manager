import { usePage } from '@inertiajs/react';
import { showNotification } from '@mantine/notifications';
import useNotificationsStore from './store/useNotificationsStore';

export default function useWebSockets() {
  const {
    auth: { user },
  } = usePage().props;
  const { addNotification } = useNotificationsStore();

  const initUserWebSocket = () => {
    window.Echo.private(`App.Models.User.${user.id}`).notification(notification => {
      addNotification(notification);

      showNotification({
        title: notification.title,
        message: notification.subtitle,
        autoClose: 8000,
      });
    });
  };

  return { initUserWebSocket };
}
