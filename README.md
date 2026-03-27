# Local Test Site

The easiest way to test plugin packages, like upgrade, downgrade, uninstallation, or when needing a discardable test environment for quick checks.

## Start the env

```shell
ddev start
```

Note: Only works when no other HTTP server is running, like "DevKinsta" or "Local by Flywheel" - stop any other services first.

## Test Site

- https://wp-test.ddev.site/wp-admin
- Login: `admin` / `admin`

## Snapshots

```shell
# List all snapshots:
ddev snapshot -l

# Create snapshot of current state:
ddev snapshot -n <name>

# Restore snapshot:
ddev snapshot restore <name>
```
