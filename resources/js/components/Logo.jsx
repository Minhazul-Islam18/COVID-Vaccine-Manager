import { usePage } from '@inertiajs/react';
import { Center, Group, Text, rem, useComputedColorScheme } from '@mantine/core';
import { IconLayoutDashboard } from '@tabler/icons-react';

export default function Logo(props) {
  const { app_name } = usePage().props;
  const computedColorScheme = useComputedColorScheme();

  return (
    <Group
      wrap='nowrap'
      {...props}
    >
      <Center
        bg={computedColorScheme === 'dark' ? 'blue.8' : 'blue.9'}
        p={5}
        style={{ borderRadius: '100%' }}
      >
        <IconLayoutDashboard
          style={{ stroke: '#fff', width: rem(25), height: rem(25), flexShrink: 0 }}
        />
      </Center>
      <Text
        fz={20}
        fw={600}
      >
        {app_name}
      </Text>
    </Group>
  );
}
