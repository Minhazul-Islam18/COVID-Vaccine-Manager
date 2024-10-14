import ContainerBox from '@/layouts/ContainerBox';
import GuestLayout from '@/layouts/GuestLayout';
import { usePage } from '@inertiajs/react';
import { Button, Select, Text, TextInput, Title } from '@mantine/core';
import { useForm } from 'laravel-precognition-react-inertia';
import classes from './css/Login.module.css';

const Register = () => {
  const { centers } = usePage().props;

  // FORM HANDLING
  const form = useForm('post', route('vaccine-manager.register.store'), {
    initialValues: {
      name: '',
      email: '',
      nid: '',
      vaccine_center_id: '',
    },
  });

  // Vaccine Centers
  const centerOptions = centers.map(center => ({
    label: center.name,
    value: String(center.id),
  }));

  const submit = e => {
    e.preventDefault();
    form.submit({
      preserveScroll: true,
      onSuccess: () => form.reset(),
      onError: errors => {
        console.log(errors);
      },
    });
  };

  return (
    <>
      <Title
        ta='center'
        className={classes.title}
      >
        Register!
      </Title>
      <Text
        c='dimmed'
        size='sm'
        ta='center'
        mt={5}
      >
        For COVID-19 Vaccine
      </Text>

      <form onSubmit={submit}>
        <ContainerBox
          shadow='md'
          p={30}
          mt={30}
          radius='md'
        >
          <Select
            label='Vaccine Center'
            placeholder='Select a center'
            data={centerOptions}
            searchable
            required
            nothingFoundMessage={'No Centers found!'}
            onChange={value => form.setData('vaccine_center_id', value)}
            error={form.errors.vaccine_center_id}
          />
          <TextInput
            label='Name'
            placeholder='Your name'
            required
            value={form.data.name}
            onChange={e => form.setData('name', e.target.value)}
            onBlur={() => form.validate('name')}
            error={form.errors.name}
          />
          <TextInput
            label='Email'
            placeholder='Your email'
            required
            value={form.data.email}
            onChange={e => form.setData('email', e.target.value)}
            onBlur={() => form.validate('email')}
            error={form.errors.email}
          />
          <TextInput
            label='NID number'
            placeholder='Enter NID number'
            required
            value={form.data.nid}
            onChange={e => form.setData('nid', e.target.value)}
            onBlur={() => form.validate('nid')}
            error={form.errors.nid}
          />
          <Button
            type='submit'
            fullWidth
            mt='xl'
            disabled={form.processing}
          >
            Sign in
          </Button>
        </ContainerBox>
      </form>
    </>
  );
};

Register.layout = page => <GuestLayout title='Register'>{page}</GuestLayout>;

export default Register;
