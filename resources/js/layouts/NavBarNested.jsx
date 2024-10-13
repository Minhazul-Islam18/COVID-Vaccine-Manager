import Logo from '@/components/Logo';
import useNavigationStore from '@/hooks/store/useNavigationStore';
import { Group, ScrollArea, rem } from '@mantine/core';
import { IconGauge, IconSettings, IconUsers } from '@tabler/icons-react';
import { useEffect } from 'react';
import NavbarLinksGroup from './NavbarLinksGroup';
import UserButton from './UserButton';
import classes from './css/NavBarNested.module.css';

export default function Sidebar() {
  const { items, setItems } = useNavigationStore();

  useEffect(() => {
    setItems([
      {
        label: 'Dashboard',
        icon: IconGauge,
        link: route('dashboard'),
        active: route().current('dashboard'),
        visible: true,
      },
      {
        label: 'Users',
        icon: IconUsers,
        link: route('users.index'),
        active: route().current('users.*'),
        visible: can('view users'),
      },
      {
        label: 'Settings',
        icon: IconSettings,
        active: route().current('settings.*'),
        opened: route().current('settings.*'),
        visible: can('view roles'),
        links: [
          {
            label: 'Roles',
            link: route('settings.roles.index'),
            active: route().current('settings.roles.*'),
            visible: can('view roles'),
          },
        ],
      },
    ]);
  }, []);

  return (
    <nav className={classes.navbar}>
      <div className={classes.header}>
        <Group justify='space-between'>
          <Logo style={{ width: rem(120) }} />
        </Group>
      </div>

      <ScrollArea className={classes.links}>
        <div className={classes.linksInner}>
          {items
            .filter(i => i.visible)
            .map(item => (
              <NavbarLinksGroup
                key={item.label}
                item={item}
              />
            ))}
        </div>
      </ScrollArea>

      <div className={classes.footer}>
        <UserButton />
      </div>
    </nav>
  );
}
