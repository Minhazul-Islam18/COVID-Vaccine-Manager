import FlashNotification from '@/components/FlashNotification';
import { Head, Link } from '@inertiajs/react';
import { Menu, Group, Center, Burger, Container, Button } from '@mantine/core';
import { useDisclosure } from '@mantine/hooks';
import { IconChevronDown } from '@tabler/icons-react';
import classes from './css/HeaderMenu.module.css';

export default function FrontendLayout({ title, children }) {
  const links = [
    { link: '/vaccine-manager', label: 'Home' },
    { link: '/vaccine-manager/vaccine-data', label: 'Check vaccination status' },
  ];

  const items = links.map(link => {
    // const menuItems = link.links?.map(item => <Menu.Item key={item.link}>{item.label}</Menu.Item>);

    // if (menuItems) {
    //   return (
    //     <Menu
    //       key={link.label}
    //       trigger='hover'
    //       transitionProps={{ exitDuration: 0 }}
    //       withinPortal
    //     >
    //       <Menu.Target>
    //         <a
    //           href={link.link}
    //           className={classes.link}
    //           onClick={event => event.preventDefault()}
    //         >
    //           <Center>
    //             <span className={classes.linkLabel}>{link.label}</span>
    //             <IconChevronDown
    //               size='0.9rem'
    //               stroke={1.5}
    //             />
    //           </Center>
    //         </a>
    //       </Menu.Target>
    //       <Menu.Dropdown>{menuItems}</Menu.Dropdown>
    //     </Menu>
    //   );
    // }

    return (
      <Link
        key={link.label}
        href={link.link}
        className={classes.link}
      >
        {link.label}
      </Link>
    );
  });
  return (
    <>
      <Head title={title} />

      <FlashNotification />
      <header className={classes.header}>
        <Container size='md'>
          <div className={classes.inner}>
            <Group
              gap={5}
              visibleFrom='sm'
            >
              {items}
            </Group>
            <Group visibleFrom='sm'>
              <Link href='/vaccine-manager/register'>
                {' '}
                <Button>Register</Button>
              </Link>
            </Group>
          </div>
        </Container>
      </header>
      <Container>{children}</Container>
    </>
  );
}
